<?PHP
use PHPUnit\Framework\TestCase;

Class LoginTest extends TestCase
{
	
	public function testGivenInvalid_WhenInvalidUsername_Then()
	{
		$SUT = "Invalid";
		$login = new Login();
		$this->assertEquals(false, $login->isInvalidUsername($SUT));
		
	}
	public function testGivenValid_WhenInvalidUsername_ThenFalse()
	{
		$SUT = "Valid";
		 $this->assertEquals(False, isInvalidUsername($SUT));
	}

	public function testGivenInvalid_WhenInvalidPassword_ThenTrue()
	{
		$username = "Logan";
		$SUT = "invalid";
	    $this->assertEquals(True, isInvalidPassword($SUT, $username));
	}
	public function testGivenValid_WheninvalidPassword_ThenFalse()
	{
		$username = "Logan";
		$SUT = "Valid";
		$this->assertEquals(False, isInvalidPassword($SUT, $username));
	}	
}

?>
