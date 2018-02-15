<?
	namespace src
	public class Login{
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
		
		function isInvalidPassword($tempPassword, $tempUsername)
		{
			global $dbc;
			$r2 = $dbc->query("SELECT Password FROM Users Where Username = '". $tempUsername. "'");
			
			if($tempPassword != $r2->fetch_Object()->Password)
			{
				return true;
			}
			return false;
			
		}
	}

?>