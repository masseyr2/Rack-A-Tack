<?PHP
	namespace Person;
	include("ExampleClass.php");
	
	 
	 
	$p2 = new PersonExample();
	$p2->setFirstName("John");
	$p2->setLastName("Rammon");
	$p2->setPhoneNumber("456-789-1230");
	?> 
	<pre><?PHP  ?></pre><br>testing...
	<pre><?PHP print_r($p2);?></pre>
	 
	

?>