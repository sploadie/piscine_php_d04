<?php
function auth($login, $passwd)
{
	if ($login  !== NULL &&
		$login  !== ""   &&
		$passwd !== NULL &&
		$passwd !== ""   &&
		file_exists("../private/passwd"))
	{
		$passwd_file = file_get_contents("../private/passwd");
		$passwd_database = unserialize($passwd_file);
		foreach ($passwd_database as $data)
		{
			if ($data['login']  === $login &&
				$data['passwd'] === hash("whirlpool", $passwd))
			{
				return true;
			}
		}
	}
	return false;
}
?>
