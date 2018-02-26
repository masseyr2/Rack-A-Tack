<?PHP
use PHPUnit\Framework\TestCase;
include("db_connect.php");

Class RegistTest extends TestCase
{
	/**
     * @covers Login::isInvalidUsername2
     */
	public function testGivenValid_WhenInvalidUsername_ThenTrue()
	{
		
		$SUT = 'Valid';
		$regist = new Login();
		$this->assertEquals(True, $regist->isInvalidUsername2($SUT));
		
	}
    /**
     * @covers Login::isInvalidUsername2
     */	
	public function testGivenInvalid_WhenInvalidUsername_ThenFalse()
	{
		
		$SUT = "Invalid";
		$regist = new Login();
		$this->assertEquals(False, $regist->isInvalidUsername2($SUT));
	}
    /**
     * @covers Login::isMatchingPassword
     */
	public function testGivenMatchingPasswords_WhenisMatchingPassword_ThenTrue()
	{
		$SUT2 = "match";
		$SUT = "match";
		$regist = new Login();
	    $this->assertEquals(True, $regist->isMatchingPassword($SUT, $SUT2));
	}
	/**
     * @covers Login::isMatchingPassword
     */
	public function testGivenValid_WhenisMatchingPassword_ThenFalse()
	{
		$SUT2 = "match";
		$SUT = "noMatch";
		$regist = new Login();
		$this->assertEquals(False, $regist->isMatchingPassword($SUT, $SUT2));
	}	
}

?>
