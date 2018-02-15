<?PHP
	namespace Person;
	class PersonExample{
		var $firstName = "";
		var $lastName = "";
		var $phoneNumber = "";
		
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
	 
	

?>