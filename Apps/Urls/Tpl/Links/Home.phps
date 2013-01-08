<?php
class U_Tpl_Links_Home extends O_Html_Template {

	/**
	 * @var O_Dao_Query
	 */
	public $links;
	/**
	 * @var U_Mdl_Env
	 */
	public $env;

	/**
	 * @var O_Dao_Paginator
	 */
	public $paginator;

	public function displayContents()
	{
?>
<h1>Your links</h1>
<?if($this->env){?>
<h2>Env#<?=$this->env->id.": ".$this->env->title?></h2>
<?}
		if ($this->paginator) {
			$this->paginator->show( $this->layout() );
		}
		$this->layout()->setTitle("Your links");
	}
}
