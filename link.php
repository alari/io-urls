<?php
// Remove first char "/" and query string
$key = substr($_SERVER["REQUEST_URI"], 1);
if(strpos($key, "?")) {
	$key=substr($key, 0, strpos($key, "?"));
}
// No key provided -- redirect
if(!$key) {
	Header("Location: http://".$_SERVER["HTTP_HOST"]."/?no-key");
	exit;
}

// Connect to database, find a line with our link
mysql_connect("localhost", "urls", "urlsdba438");
mysql_select_db("urls");
$r = mysql_query("SELECT id, full_url FROM links WHERE short_key='".mysql_real_escape_string($key)."'");
$a = mysql_fetch_assoc($r);

// Link is not present -- redirect
if(!is_array($a)) {
	Header("Location: http://".$_SERVER["HTTP_HOST"]."/?no-full-url");
	exit;
}

// Prepare referer data
$path = "";
$host = "";
if(isset($_SERVER["HTTP_REFERER"]) && $_SERVER["HTTP_REFERER"]) {
	$ref = parse_url($_SERVER["HTTP_REFERER"]);
	$path = mysql_real_escape_string($ref["path"]);
	$host = mysql_real_escape_string($ref["host"]);
}

// Save stats in a database
mysql_query("INSERT INTO link_stats(link,time,remote_addr,referer_host,referer_path)
	VALUES({$a['id']},UNIX_TIMESTAMP(),'".mysql_real_escape_string($_SERVER["REMOTE_ADDR"])."','$host','$path')");

// Redirect to target url
Header("Location: ".$a["full_url"]);

// Update link cache
mysql_query("UPDATE links SET stats_count=stats_count+1 WHERE id=".$a["id"]);