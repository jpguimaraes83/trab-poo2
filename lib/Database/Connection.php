<?php

	abstract class Connection
	{
		private static $conn;

		public static function getConn()
		{
			$dns = 'pgsql:host=200.18.128.54;dbname=aula';
			$user = "aula";
			$pass = "aula";
			$options = null;
			
			if (self::$conn == null) {
				self::$conn = new PDO($dns,$user,$pass,$options);
				
			}
			
			return self::$conn;

		}
	}