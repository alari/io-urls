<?php
/**
 * @table users
 *
 * @field email VARCHAR(255)
 * @field nickname VARCHAR(255)
 *
 * @field api_key CHAR(32) UNIQUE DEFAULT ''
 *
 * @field links -owns many _Link -inverse owner -order-by stats_count DESC
 * @field envs -owns many _Env -inverse owner
 *
 * @index email -unique
 */
class U_Mdl_User extends O_Acl_User {
	public function __construct($identity, O_Acl_Role $role = null) {
		if (! $role)
			$role = O_Acl_Role::getByName ( "OpenId User" );
		O_OpenId_Provider_UserPlugin::normalize ( $identity );
		$this->identity = $identity;
		$this->role = $role;
		parent::__construct ();
		$this->nickname = rtrim ( substr ( $identity, 7 ), "/" );
		$this->api_key = md5($this->identity);
		$this->save();
	}

	public function getApiKey() {
		if($this->api_key) return $this->api_key;
		$this->api_key = md5($this->identity.mt_rand().microtime(true));
		$this->save();
		return $this->api_key;
	}
}