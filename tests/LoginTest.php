<?PHP
use PHPUnit\Framework\TestCase;
include("db_connect.php");

Class LoginTest extends TestCase
{
	/**
     * @covers Login::IsInvalidUsername
     */
	public function testGivenInvalid_WhenInvalidUsername_ThenTrue()
	{
		
		$username = 'Invalid';
		$SUT = new Login();
		$this->assertEquals(True, $SUT->isInvalidUsername($username));
		
	}	
	/**
     * @covers Login::IsInvalidUsername
     */
	public function testGivenValid_WhenInvalidUsername_ThenFalse()
	{
		
		$username = "Valid";
		$SUT = new Login();
		$this->assertEquals(False, $SUT->isInvalidUsername($username));
	}

	/**
     * @covers Login::IsInvalidPassword
     */
	public function testGivenInvalid_WhenInvalidPassword_ThenTrue()
	{
		$username = "Logan";
		$password = "invalid";
		$SUT = new Login();
	    $this->assertEquals(True, $SUT->isInvalidPassword($password, $username));
	}
	
	/**
     * @covers Login::IsInvalidPassword
     */
	public function testGivenValid_WheninvalidPassword_ThenFalse()
	{
		$username = "Logan";
		$password = "Valid";
		$SUT = new Login();
		$this->assertEquals(False, $SUT->isInvalidPassword($password, $username));
	}
	/**
	 * @covers Login::IsInvalidStaffUsername
	 */
	public function testGivenLogan_WhenInvalidStaffUsername_ThenTrue()
	{
		$username = "Logan";
		$SUT = new Login();
	    $this->assertEquals(True, $SUT->isInvalidStaffUsername($username));
	}
	
	/**
	 * @covers Login::IsInvalidStaffUsername
	 */
	public function testGivenMassey_WhenInvalidStaffUsername_ThenFalse()
	{
		$username = "Massey";
		$SUT = new Login();
		$this->assertEquals(False, $SUT->isInvalidStaffUsername($username));
	}	
}

?>
