<!DOCTYPE html>
<html>
	<head>
		<title>	Homework 2.0</title>
	</head>
	<body>
		<?php
			function getElectivesFromDB($id) {
				$conn=new PDO('mysql:host=localhost;dbname=webtechnologies', 'root', '');
				// Странно, но ако $id е например 2t или друг integer последван от чар, тази заявка ще върне резултат
				// Тествах и в phpmyadmin конзолата с '2t';
				$query="SELECT TITLE, DESCRIPTION, LECTURER, CREATED_AT FROM electives WHERE ID=?;";
				$stmt=$conn->prepare($query);
				$stmt->execute([$id]);
				while($row=$stmt->fetch()) {
					// Тук съм извел само TITLE, LECTURER, DESCRIPTION защото по условие само тези бяха указани да се съхраняват
					echo "<form method=\"POST\">
						      <label for=\"id\">Id: </label>
						      <input type=\"text\" name=\"id\"/>
							  <label for=\"name\">Name: </label>
							  <input type=\"text\" name=\"name\" value=\"{$row['TITLE']}\"/>
							  <label for=\"lecturer\">Lecturer:</label>
							  <input type=\"text\" name=\"lecturer\" value=\"{$row['LECTURER']}\">
							  <label for=\"description\">Description: </label>
							  <input type=\"text\" name=\"description\" value=\"{$row['DESCRIPTION']}\">
							  <label for=\"group\">Group: </label>
							  <select name=\"group\">
								<option>М</option>
								<option>ПМ</option>
								<option>ОКН</option>
								<option>ЯКН</option>
							  </select>
							  <label for=\"credits\">Credits: </label>
							  <input type=\"text\" name=\"credits\">

							  <input type=\"submit\" value=\"Modify elective\"/>
							</form>";
				}
			}

			function modifyElective($id, $name, $lecturer, $description) {
				$conn=new PDO('mysql:host=localhost;dbname=webtechnologies', 'root', '');
				// Странно, но ако $id е например 2t или друг integer последван от чар, тази заявка ще върне резултат
				// Тествах и в phpmyadmin конзолата с '2t';
				$query="UPDATE electives set LECTURER=?, DESCRIPTION=?, TITLE=? WHERE ID=?;";
				$stmt=$conn->prepare($query);
				$stmt->execute([$lecturer, $description, $name, $id]);
			}

			if (isset($_POST['id'])) {
				$id = $_POST['id'];
				$lecturer = $_POST['lecturer'];
				$description = $_POST['description'];
				$title = $_POST['name'];
				modifyElective($id, $title, $lecturer, $description);
			}
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				getElectivesFromDB($id);
			}
		?>
	</body>
</html>
