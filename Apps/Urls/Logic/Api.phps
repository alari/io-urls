<?php
// TODO: make this suitable for both U_Cmd_Home and U_Cmd_Api_*
class U_Logic_Api {

	const STATUS_OK = "SUCCEED";
	const STATUS_FAIL = "FAILED";

	/**
	 * API holder user
	 * @var U_Mdl_User
	 */
	protected $user;
	/**
	 * Environment object, if present
	 * @var U_Mdl_Env
	 */
	protected $env;
	/**
	 * Error message
	 * @var string
	 */
	protected $errorMsg;
	/**
	 * Command to get params from
	 * @var O_Command
	 */
	protected $command;

	/**
	 * Creates new API logic instance
	 * @param O_Command $command to get params from
	 */
	function __construct( O_Command $command, $getUserFromApi = false )
	{
		$this->command = $command;
		if (!$getUserFromApi) {
			$this->user = U_Mdl_Session::isLogged() ? U_Mdl_Session::getUser() : null;
			if ($this->user) {
				if ($this->command->getParam( "env" )) {
					$this->env = $this->user->envs->test( "id", $this->command->getParam( "env" ) )->getOne();
				}
				if (!$this->env && $this->command->getParam( "env_new" )) {
					try {
						$this->env = new U_Mdl_Env( $this->user, $this->command->getParam( "env_new" ) );
					}
					catch (PDOException $e) {
						$this->env = $this->user->envs->test( "title", $this->command->getParam( "env_new" ) )->getOne();
					}
				}
			}
		} else {
			$this->user = U_Mdl_User::getQuery()->test( "api_key", $this->command->getParam( "api_key" ) )->getOne();
			$this->env = $this->user->envs->test( "id", $this->command->getParam( "env" ) )->getOne();
			if (!$this->user) {
				$this->errorMsg = "Unregistered API key";
			}
		}
	}

	/**
	 * Error notifier
	 * @param string $errorMsg
	 */
	private function getFormattedError( $errorMsg )
	{
		return Array ("status" => self::STATUS_FAIL, "error_msg" => $errorMsg);
	}

	/**
	 * Gets link array
	 * @return Array with link info
	 */
	public function getShortLinkArray()
	{
		if ($this->errorMsg) {
			return $this->getFormattedError( $this->errorMsg );
		}

		$url = urldecode( $this->command->getParam( "full_url", $this->command->getParam("_full_url") ) );
		if (!$url) {
			return $this->getFormattedError( "No url given" );
		}
		$key = $this->command->getParam( "short_key" );

		$getLink = function ($q) use ($url){
			return $q->test( "full_url", $url )->getOne();
		};

		$link = null;
		if ($this->env) {
			$link = $getLink($this->env->links);
		} elseif ($this->user){
			$link = $getLink($this->user->links);
		}

		if (!$link && !$this->user) {
			$link = $getLink(U_Mdl_Link::getQuery());
		}

		if (!$link) {
			try {
				$link = new U_Mdl_Link( $url, $key );
			}
			catch (PDOException $e) {
				return $this->getFormattedError( "Not unique key" );
			}
			catch (O_Ex_WrongArgument $e) {
				return $this->getFormattedError( $e->getMessage() );
			}

			$link->owner = $this->user;
			$link->env = $this->env;
			$link->save();
		}
		return Array ("short_key" => $link->short_key, "short_url" => $link->getShortUrl(), "status" => self::STATUS_OK);
	}

	/**
	 * Returns full url
	 * @return Array with link info
	 */
	public function getFullLinkArray()
	{
		if ($this->errorMsg) {
			return $this->getFormattedError( $this->errorMsg );
		}
		$key = $this->command->getParam( "short_key" );
		$link = $this->user->links->test( "short_key", $key )->getOne();

		if ($link) {
			return Array ("status" => self::STATUS_OK, "full_url" => $link->getFullUrl());
		}

		return $this->getFormattedError( "Could not find link." );
	}
}
