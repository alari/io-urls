<?php
class U_Tpl_Home extends O_Html_Template {

	public $errorMsg = "";
	public $shortUrl = null;

	public $fullUrl = "";
	public $shortKey = "";

	public $envId;

	public function displayContents()
	{
?>
<h1>URLs I\O</h1>
<h2>Control your links</h2>

<?if($this->shortUrl || $this->errorMsg){?>
<div id="attention">
<h4>
	<?if($this->shortUrl){?>
		Resulting URL: <a target="_blank" href="<?=$this->shortUrl?>"><?=$this->shortUrl?></a>
	<?}else{?>
		Error: <?=$this->errorMsg?><br />
		Try Again.
	<?}?>
</h4>
</div>
<?}?>

<form method="post">
<fieldset>
<legend>Make url short</legend>
<div><b>Full URL</b>: <input type="text" name="_full_url" maxlength="255" value="<?=htmlspecialchars($this->fullUrl)?>"/></div>
<div>Key (optional): http://<?=$_SERVER["HTTP_HOST"]?>/<input type="text" name="short_key" maxlength="16" value="<?=htmlspecialchars($this->shortKey)?>"/></div>
<?if(U_Mdl_Session::isLogged()){?>
	<div>
	Env (opt): <select name="env_id"><option value="">- blank or new -</option>
		<?foreach(U_Mdl_Session::getUser()->envs as $e){?>
		<option value="<?=$e["id"]?>"<?=($e["id"]==$this->envId?' selected="yes"':"")?>>#<?=$e["id"].": ".htmlspecialchars($e->title)?></option>
		<?}?>
	</select> &nbsp; <input type="text" name="env_new" maxlength="32"/>
	</div>
<?}?>
<div><input type="submit" value="Run"/></div>
</fieldset>
</form>
<?
		$this->layout()->setTitle('URLs I\O : control your links');
	}
}
