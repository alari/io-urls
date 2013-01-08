<?php
class U_Cmd_OpenId_Login extends O_OpenId_Consumer_Command {

	protected function authSuccess( Auth_OpenID_SuccessResponse $response )
	{
		$identity = $response->getDisplayIdentifier();
		$user = O_OpenId_Provider_UserPlugin::getByIdentity( $identity );
		if (!$user) {
			$user = new U_Mdl_User( $identity, O_Acl_Role::getByName( "OpenId User" ) );
		}
		$sreg = $this->getSRegResponse( $response );
		if (!$user->email && isset( $sreg[ 'email' ] ) && $sreg[ 'email' ]) {
			$user->email = $sreg[ 'email' ];
		}
		if (!$user->nickname && isset( $sreg[ 'nickname' ] ) && $sreg[ 'nickname' ]) {
			$user->nickname = $sreg[ 'nickname' ];
		}
		$user->save();
		U_Mdl_Session::setUser( $user );
		return $this->successRedirect();
	}

	private function successRedirect()
	{
		return $this->redirect( "/" );
	}

}