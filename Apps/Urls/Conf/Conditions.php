<?php
O("*conditions", function(){
	if(O("~http_host") == "urls.dev"){
		O("*mode", "development");
		O("_db/default", Array("engine"=>"-"));
	} else {
		O("*mode", "production");
		O("_db/default", Array(
			"engine"=>"mysql",
			"host"=>"localhost:3306",
			"dbname"=>"urls",
			"user"=>"urls",
			"password"=>"urlsdba438"
		));
	}
	O("_prefix", "U");
	O("_ext", "phps");
});