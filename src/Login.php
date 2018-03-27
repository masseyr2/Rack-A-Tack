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
		
		function isInvalidStaffUsername($tempUsername)
		{
		global $dbc;
		$r2 = $dbc -> query("SELECT UserID FROM Users WHERE Username = '". $tempUsername. "'");
		$r3 = $r2 -> fetch_Object() -> UserID;
		$r4 = $dbc -> query("SELECT * FROM LeagueStaff WHERE UserID = '". $r3. "'");
		
		if (mysqli_num_rows($r4) == 0)
		{
			return true;
		}
		
		return false;
		}
	}

?>