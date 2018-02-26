<?php
	
	final class Login
	{
		function isInvalidUsername($tempUsername)
		{
			global $dbc;
			
			$r = $dbc->query("SELECT * FROM Users Where Username = '". $tempUsername. "'");
			
			if(mysqli_num_rows($r) == 0)
			{
				return true;
			}
			
			return false;
			
		}
		
		function isInvalidPassword(string $tempPassword, string $tempUsername)
		{
			global $dbc;
			$tempPassword = md5($tempPassword);
			$r2 = $dbc->query("SELECT Password FROM Users Where Username = '". $tempUsername. "'");
			
			if($tempPassword != $r2->fetch_Object()->Password)
			{
				return true;
			}
			return false;
			
		}
		
		function isInvalidUsername2($tempUsername)
		{
			global $dbc;
			
			$r = $dbc->query("SELECT * FROM Users Where Username = '". $tempUsername. "'");
			
			if(mysqli_num_rows($r) != 0)
			{
				return true;
			}
			
			return false;
			
		}
		
		function isMatchingPassword($tempPassword, $tempPassword2)
		{
			if($tempPassword == $tempPassword2)
				return true;
			
			return false;
			
		}
	}

?>