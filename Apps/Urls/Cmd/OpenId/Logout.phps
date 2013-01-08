<?php
class U_Cmd_OpenId_Logout extends O_Command {

	public function process()
	{
		U_Mdl_Session::delUser();
		return $this->redirect( "/" );
	}
}