<?php
class U_Fr_Link {
	static public function showCallback(O_Dao_Renderer_Show_Params $param) {
		$link = $param->record();
?>
<li>(<?=$link->stats_count?>) <a href="/links/<?=$link->short_key?>"><?=htmlspecialchars($link->full_url)?></a> &ndash; <i><?=$link->getShortUrl()?></i>
<?if($link->env){?>
&nbsp; <small>Env: <a href="/links/env.<?=$link["env"]?>"><?=$link->env->title?></a></small>
<?}?>
</li>
<?
	}
}
