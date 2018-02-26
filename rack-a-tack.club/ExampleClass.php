<?PHP

	class PersonExample{
		public $firstName = "";
		public $lastName = "";
		public $phoneNumber = "";
		
		public function getPhoneNumber(){
			return $phoneNumber;
		}
		public function  getFirstName(){
			return $firstName;
		}
		public function  getLastName(){
			return $lastName;
		}
		public function  setFirstName($fn){
			$this->firstName = $fn;
		}
		public function setLastName($fn){
			$this->lastName = $fn;
		}
		public function setPhoneNumber($fn){
			$this->phoneNumber = $fn;
		}
		public function  getInfo(){
			$output = "Name: ".getFirstName(). " ". getLastName(). "<br>Phone#: ". getPhoneNumber();
			return $output;
		}
	}
	echo "Hello";
	$p1 = new PersonExample();
	$p1->setFirstName("Ryan");
	$p1->setLastName("Massey");
	$p1->setPhoneNumber("123-456-7890");
	print_r($p1);
	

?>