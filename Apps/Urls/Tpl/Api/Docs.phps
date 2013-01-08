<?php
class U_Tpl_Api_Docs extends O_Html_Template {

	public function displayContents()
	{
?>
<h1>URLs I/O API</h1>
<p>Our service has simple but powerfull API, callable via HTTP GET. It requires API key, which you get automatically after logging in.</p>
<p>All responces are in JSON.</p>
<h2>Get short url from the long one</h2>
<h3>URL: http://urls.io/api/get-short</h3>
<dl>
  <dt>Arguments:</dt>
  <dd>
<dl>
<dt>api_key</dt>
<dd>API key given to you after authentication.</dd>
<dt>env</dt>
<dd>Optional environment number (integer). Helps you to look after several sites you're placing links on.</dd>
<dt>full_url</dt>
<dd>Fully-specified URL you wish to make shorter.</dd>
<dt>short_key</dt>
<dd>Optional desirable short key. If it's not suitable, error will be returned.</dd>
</dl>
</dd>
<dt>Success response:</dt>
<dd>
<dl>
<dt>status</dt><dd>SUCCEED</dd>
<dt>short_url</dt><dd>Provided short address.</dd>
<dt>short_key</dt><dd>Short key given to identify your link.</dd>
</dl>
</dd>
<dt>Error responce:</dt>
<dd>
<dl>
<dt>status</dt><dd>FAILED</dd>
<dt>error_msg</dt><dd>Short explanation of failure reasons.</dd>
</dl>
</dd>
</dl>
<?
	}
}