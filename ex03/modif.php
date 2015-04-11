<?php
if ($_POST['login'] !== NULL &&
	$_POST['login'] !== ""   &&
	$_POST['oldpw'] !== NULL &&
	$_POST['oldpw'] !== ""   &&
	$_POST['newpw'] !== NULL &&
	$_POST['newpw'] !== ""   &&
	$_POST['submit'] === "OK")
{
	$passwd_file = file_get_contents("../private/passwd");
	if (!$passwd_file) {
		echo "ERROR\n";
		return ;
	}
	$passwd_database = unserialize($passwd_file);
	foreach ($passwd_database as $key => $data)
	{
		if ($data['login'] === $_POST['login']) {
			$found_key = $key;
			break ;
		}
	}
	if ($found_key === NULL || $passwd_database[$found_key]['passwd'] !== hash("whirlpool", $_POST['oldpw'])) {
		echo "ERROR\n";
		return ;
	}
	$passwd_database[$found_key]['passwd'] = hash("whirlpool", $_POST['newpw']);
	$_POST['oldpw'] = ""; // Because trash data.
	$_POST['newpw'] = ""; // Because trash data.
	$passwd_file = serialize($passwd_database);
	file_put_contents("../private/passwd", $passwd_file);
	echo "OK\n";
}
else
	echo "ERROR\n";
?>
