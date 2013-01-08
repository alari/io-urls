<?php
class U_Tpl_Links_Stat extends O_Html_Template {

	/**
	 * @var U_Mdl_Link
	 */
	public $link;

	public function displayContents()
	{
?>
<h1>Link: <?=$this->link->getShortUrl()?></h1>
<h2><a href="<?=$this->link->full_url?>" target="_blank"><?=$this->link->full_url?></a></h2>
<ul>
<?
		foreach($this->link->stats as $stat) {
			/* @var $stat U_Mdl_Stat */
?><li><?=date("d.m.Y H:i:s", $stat->time)?>;
<i>Referer: <?if(!$stat->referer_host) echo "Unknown"; else {
	$ref = "http://".$stat->referer_host.$stat->referer_path;?>
		<a href="<?=$ref?>"><?=$ref?></a>
	<?}?></i></li><?
		}
?>
</ul>
<?
		$this->layout()->setTitle("Link stats info");
	}
}