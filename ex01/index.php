<?php
session_start();
if ($_GET['submit'] === 'OK')
{
	$_SESSION['login'] = $_GET['login'];
	$_SESSION['passwd'] = $_GET['passwd'];
}
$login = $_SESSION['login'];
$passwd = $_SESSION['passwd'];
echo <<<EOT
<html><body>
<form method="get" action="index.php">
   Identifiant: <input type="text" name="login" value="$login"/>
   <br />
   Mot de passe: <input type="password" name="passwd" value="$passwd"/>
  <input type="submit" name="submit" value="OK" />
</form>
</body></html>

EOT;
?>
