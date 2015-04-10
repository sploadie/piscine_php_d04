<?php
if ($_POST['submit'] === "OK" && $_POST['login'] !== NULL && $_POST['passwd'] !== NULL && $_POST['login'] !== "" && $_POST['passwd'] !== "")
{
	if (!file_exists("../private"))
		mkdir("../private");
	if (!file_exists("../private/passwd"))
		file_put_contents("../private/passwd", "");
	$passwd_file = file_get_contents("../private/passwd");
	$passwd_database = unserialize($passwd_file);
	foreach ($passwd_database as $data)
	{
		if ($data['login'] == $_POST['login'])
		{
			echo "ERROR\n";
			return ;
		}
	}
	$passwd_new['login'] = $_POST['login'];
	$passwd_new['passwd'] = hash("whirlpool", $_POST['passwd']);
	$_POST['passwd'] = ""; // Because trash data.
	$passwd_database[] = $passwd_new;
	$passwd_file = serialize($passwd_database);
	file_put_contents("../private/passwd", $passwd_file);
	echo "OK\n";
}
else
	echo "ERROR\n";
?>
