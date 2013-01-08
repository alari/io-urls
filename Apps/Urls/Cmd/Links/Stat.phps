<?php
class U_Cmd_Links_Stat extends O_Command {

	private $link;

	public function process()
	{
		$tpl = $this->getTemplate();
		// TODO: add fancy logics
		$tpl->link = $this->link;
		return $tpl;
	}

	public function isAuthenticated() {
		if(!U_Mdl_Session::isLogged()) return false;
		$this->link = O_Registry::get("app/current/link");
		if(!$this->link) return false;
		if($this->link->owner != U_Mdl_Session::getUser()) return false;
		return true;
	}
}