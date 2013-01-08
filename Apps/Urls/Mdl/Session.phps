<?php
class U_Mdl_Session extends O_Acl_Session {

	/**
	 * Returns current user identity
	 *
	 * @return string
	 */
	static public function getIdentity()
	{
		if (!self::isLogged())
			return null;
		return self::getUser()->identity;
	}
}