<html>
<?php
session_start();
session_destroy();
?>
<body onLoad="timer=setTimeout(function(){ window.location='http://localhost/eclass/Authenticate.php';}, 1000)">
<p>access denied, 'ADMIN' level required</p>
<p>please wait redirecting....</p>
</body>
</html>