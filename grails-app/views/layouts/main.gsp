<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title><g:layoutTitle default="URLs I\\O : control your links"/></title>
		<g:layoutHead/>
        <r:require module="application"/>
		<r:layoutResources />
	</head>
	<body>

    <div id="oid">
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
    </div>

    <div id="c">

		<g:layoutBody/>

    </div>

    <div id="bottom">
        Currently controlled: ${io.urls.Link.count} links / ${io.urls.Click.count} references
        <br/><g:link uri="/api/docs">API Docs</g:link>
    </div>

        <r:layoutResources />
	</body>
</html>

</body>
</html>
