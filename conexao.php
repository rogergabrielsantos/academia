<?php

		error_reporting(E_ALL ^ E_DEPRECATED);
		
$host='localhost';
		$user='root';
		$pass='';
		$banco='academia';
		$conexao= mysql_connect($host,$user,$pass) or die(mysql_error());
		mysql_select_db($banco) or die(mysql_error());


?>