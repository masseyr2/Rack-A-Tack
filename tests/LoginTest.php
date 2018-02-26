<?PHP
use PHPUnit\Framework\TestCase;
include("db_connect.php");

Class LoginTest extends TestCase
{
	/**
     * @covers Login::IsInvalidUsername
     */
	public function testGivenInvalid_WhenInvalidUsername_Then()
	{
		
		$SUT = 'Invalid';
		$login = new Login();
		$this->assertEquals(True, $login->isInvalidUsername('Invalid'));
		
	}	
	/**
     * @covers Login::IsInvalidUsername
     */
	public function testGivenValid_WhenInvalidUsername_ThenFalse()
	{
		
		$SUT = "Valid";
		$login = new Login();
		$this->assertEquals(False, $login->isInvalidUsername($SUT));
	}

	/**
     * @covers Login::IsInvalidPassword
     */
	public function testGivenInvalid_WhenInvalidPassword_ThenTrue()
	{
		$username = "Logan";
		$SUT = "invalid";
		$login = new Login();
	    $this->assertEquals(True, $login->isInvalidPassword($SUT, $username));
	}
	
	/**
     * @covers Login::IsInvalidPassword
     */
	public function testGivenValid_WheninvalidPassword_ThenFalse()
	{
		$username = "Logan";
		$SUT = "Valid";
		$login = new Login();
		$this->assertEquals(False, $login->isInvalidPassword($SUT, $username));
	}	
}

?>
