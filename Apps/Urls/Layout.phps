<?php
class U_Layout extends O_Html_Layout {

	protected $cssSrc = Array("/static/style.css");

	/**
	 * redefine O_Html_Layout::displayDoctype()
	 *
	 */
	protected function displayDoctype()
	{
		echo'<?xml version="1.0" encoding="UTF-8"?>'?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?
	}

	/**
	 * Displays template contents (and whole layout)
	 */
	protected function displayBody() {
		$this->displayUserBox();
?>
<div id="c">
<?$this->tpl->displayContents();?>
</div>
<div id="bottom">
Currently controlled: <?=U_Mdl_Link::getQuery()->getFunc()?> links / <?=U_Mdl_Stat::getQuery()->getFunc()?> references
<br/><a href="/api/docs">API Docs</a>
</div>
<?
	}

	/**
	 * Shows user menu or login box
	 */
	protected function displayUserBox() {
?>
<div id="oid">
<?if(U_Mdl_Session::isLogged()){?>
Hello, <a href="<?=U_Mdl_Session::getUser()->identity?>"><?=U_Mdl_Session::getUser()->nickname?></a>.
	<a href="/">Home</a>
	<a href="/links/">Your links</a>
	<a href="/api/docs">API Docs</a>
	<a href="/open-id/logout">Log out</a>
	<br/>
Your API key: <?=U_Mdl_Session::getUser()->getApiKey()?>
<?}else{?>
<form method="post"
	action="/open-id/login">

<input type="text" name="openid_identifier" class="openid-blur"
	value="OpenID"
	onfocus="this.className='openid-focus';this.value=this.value=='OpenID'?'':this.value"
	onblur="this.value = this.value ? this.value : 'OpenID';if(this.value=='OpenID') this.className = 'openid-blur'"
	class="openid-blur" /> <input type="submit" value="Sign Up"
	id="openid-signup" />
	<input type="hidden" name="openid_action" value="login" />
</form>
<?}?>
</div>
<?
	}
}