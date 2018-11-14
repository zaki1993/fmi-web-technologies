<!DOCTYPE html>
<html>
	<head>
		<title>	Homework 2.0</title>
	</head>
	<body>
		<form method="POST">
		  <label for="name">Name: </label>
		  <input type="text" name="name"/>
		  <label for="lectrer">Lecturer:</label>
		  <input type="text" name="lecturer">
		  <label for="description">Description: </label>
		  <input type="text" name="description">
		  <label for="group">Group: </label>
		  <select name="group">
			<option>М</option>
			<option>ПМ</option>
			<option>ОКН</option>
			<option>ЯКН</option>
		  </select>
		  <label for="credits">Credits: </label>
		  <input type="text" name="credits">
		  
		  <input type="submit" value="Add elective"/>
		</form>

		<?php
			$electives = array();
			
			if(isset($_POST['name']) &&
  			   isset($_POST['lecturer']) &&
 			   isset($_POST['description']) &&
			   isset($_POST['group']) &&
			   isset($_POST['credits'])) {
			    try {
			   		$elective = new Elective($_POST['name'], $_POST['lecturer'], $_POST['description'], $_POST['group'], $_POST['credits']);
			   		echo $elective->print();
					echo "<script>alert(\"Elective added!\")</script>";
				} catch (Exception $e) {
					echo "<script>alert(\"{$e->getMessage()}\")</script>";
				}
			}		
		?>

	<?php
		class Elective {
					
			private const GROUP_TYPES = array('М', 'ПМ', 'ОКН', 'ЯКН');
			
			private $name;
			private $lecturer;
			private $description;
			private $group;
			private $credits;
			
			function __construct($name, $lecturer, $description, $group, $credits) {
				self::__init($name, $lecturer, $description, $group, $credits);
				$message=self::__validate($name, $lecturer, $description, $group, $credits);
				if ($message !== NULL) {
					throw new Exception($message);
				}
			}
			
			public function print() {
				return "Name: {$this->getName()}, Lecturer: {$this->getLecturer()}, Description: {$this->getDescription()}, Group: {$this->getGroup()}, Credits: {$this->getCredits()}";
			}
			
			private function __init($name, $lecturer, $description, $group, $credits) {
				$this->name=$name;
				$this->lecturer=$lecturer;
				$this->description=$description;
				$this->group=$group;
				$this->credits=$credits;
			}
			
			private function __validate($name, $lecturer, $description, $group, $credits) {
				$message=NULL;
				if(strlen($name) > 150) {
					$message.="Name length should be <= 150. ";
				}
				if(strlen($lecturer) > 200) {
					$message.="Lecturer length should be <= 200. ";
				}
				if(strlen($description) < 10) {
					$message.="Description length should be >= 10. ";
				}
				if (!is_int($credits) && $credits<=0) {
					$message.="Credits should be > 0 and integer. ";
				}
				if (!in_array($group, self::GROUP_TYPES)){
					$message.="Group should be in 'М', 'ПМ', 'ОКН', 'ЯКН' in bulgarian. ";
				}
				return $message;
			}
			
			public function getName() {
				return $this->name;
			}
			
			public function getLecturer() {
				return $this->lecturer;
			}
			
			public function getDescription() {
				return $this->description;
			}
			
			public function getGroup() {
				return $this->group;
			}
			
			public function getCredits() {
				return $this->credits;
			}				
		}
	?>
	</body>
</html>
