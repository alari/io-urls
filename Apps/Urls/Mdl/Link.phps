<?php
/**
 * @table links -loop:envelop container ul
 *
 * @field full_url VARCHAR(255) NOT NULL
 * @field short_key VARCHAR(16) NOT NULL COLLATE utf8_bin
 *
 * @field stats_count INT NOT NULL DEFAULT 0
 *
 * @field stats -owns many _Stat -inverse link
 * @field owner -has one _User -inverse links
 * @field env -has one _Env -inverse links
 *
 * @index stats_count
 * @index short_key -unique
 * @tail Engine=MyISAM
 */
class U_Mdl_Link extends O_Dao_ActiveRecord {
	const KEY_CHARS = "-_0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	const KEY_LENGTH = 5;

	public function __construct($full_url, $short_key=null) {
		if(!self::checkFullUrl($full_url)) {
			throw new O_Ex_WrongArgument("Wrong URL given");
		}
		$this->full_url = $full_url;
		if(!$short_key) {
			$short_key = $this->generateShortKey();
		} else {
			if(!self::checkShortKey($short_key)){
				throw new O_Ex_WrongArgument("Wrong key value");
			}
		}
		$this->short_key = $short_key;
		parent::__construct();
		if(U_Mdl_Session::isLogged()) {
			$this->owner = U_Mdl_Session::getUser();
			$this->save();
		}
	}

	/**
	 * Returns generated short url
	 *
	 * @return string
	 */
	public function getShortUrl() {
		return "http://".$_SERVER["HTTP_HOST"]."/".$this["short_key"];
	}

	/**
	 * Returns true if key contains only valid chars, false elsewhere
	 *
	 * @param string $key
	 * @return bool
	 */
	static public function checkShortKey($key) {
		return preg_match("#^[".self::KEY_CHARS."]+$#i", $key);
	}

	/**
	 * Checks validity of url
	 *
	 * @param string $url
	 * @return bool
	 */
	static public function checkFullUrl($url) {
		if(!$url) {
			return false;
		}
		try {
			$parts = @parse_url($url);
		} catch(O_Ex_Error $e) {
			return false;
		}
		if(!isset($parts["host"]) || !$parts["host"]) return false;
		if(!isset($parts["scheme"]) || !$parts["scheme"] || ($parts["scheme"] != "http" && $parts["scheme"] != "https")) return false;
		return true;
	}

	/**
	 * Generates unused short key
	 *
	 * @return string
	 */
	static private function generateShortKey() {
		$key = '';
		$chars = self::KEY_CHARS;
		for($i=0; $i<self::KEY_LENGTH; ++$i) {
			$key .= $chars[mt_rand(0, strlen($chars)-1)];
		}
		if(self::getByShortKey($key) instanceof self) {
			return self::generateShortKey();
		}
		return $key;
	}

	/**
	 * Returns object by its short key
	 *
	 * @param string $key
	 * @return U_Mdl_Link
	 */
	static public function getByShortKey($key) {
		return static::getQuery()->test("short_key", $key)->getOne();
	}
}
