<!DOCTYPE html>
<html>
	<head>
		<meta name="layout" content="main"/>

	</head>
	<body>
    <h1>URLs I\O</h1>
    <h2>Control your links</h2>


    <g:formRemote name="m" url="[controller:'link',action:'create']" update="u">
        <fieldset>
            <legend>Make url short</legend>
            <div><b>Full URL</b>: <input type="url" name="fullUrl" maxlength="255" value=""/></div>
            <div>Key (optional): http://urls.io/<input type="text" name="shortKey" maxlength="16" value=""/></div>
            <div><input type="submit" value="Run"/></div>
        </fieldset>
        <div id="u"></div>
    </g:formRemote>
	</body>
</html>
