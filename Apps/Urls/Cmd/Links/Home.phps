<?php
class U_Cmd_Links_Home extends O_Command {
	private $url_base = null;

	public function process()
	{
		$tpl = $this->getTemplate();

		if(O_Registry::get("app/current/env") && O_Registry::get("app/current/env")->owner == U_Mdl_Session::getUser()) {
			$tpl->links = O_Registry::get("app/current/env")->links;
			$tpl->env = O_Registry::get("app/current/env");
		} else {
			$tpl->links = U_Mdl_Session::getUser()->links;
		}
		$tpl->paginator = $tpl->links->getPaginator( array ($this, "url") );
		$tpl->paginator->setModeAjax();
		if ($tpl->paginator->isAjaxPageRequest()) {
			$tpl->paginator->show( $tpl->layout() );
			return;
		}
		return $tpl;
	}

	public function isAuthenticated() {
		return U_Mdl_Session::isLogged();
	}

	public function url( $page )
	{
		if(!$this->url_base) {
			$this->url_base = "links/";
			if(O_Registry::get("app/current/env")) {
				$this->url_base .= "env.".O_Registry::get("app/current/env")->id;
			}
		}

		return O_UrlBuilder::get( $this->url_base.($page>1?".".$page:"") );
	}
}
