<?php
O("*url_dispatcher", function(){
	$URL = function($pattern, &$matches=null) {
		return preg_match("#^$pattern$#i", O("~process_url"), $matches);
	};
	$m = Array();
	if(!O("~process_url")) {
		O("*command", "Home");
	} elseif($URL('links/(env\.([0-9]+))?(\.([0-9]+))?', $m)) {
		O("*env", U_Mdl_Env::getById($m[2]));
		O("*paginator/page", $m[4]);
		O("*command", "Links_Home");
	} elseif($URL('links/([-_a-zA-Z0-9]+)', $m)) {
		O("*link", U_Mdl_Link::getByShortKey($m[1]));
		O("*command", "Links_Stat");
	}
});