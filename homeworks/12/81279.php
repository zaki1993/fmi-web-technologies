<!DOCTYPE html>
<html>
    <head>
        <title>Homework 1.2</title>
    </head>
    <body>
        <?php
			/*
				$data = [
				  'webgl' => [
					'title' => 'Компютърна графика с WebGL',
					'description' => '...',
					'lecturer' => 'доц. П. Бойчев',
				  ],
				  'go' => [
					'title' => 'Програмиране с Go',
					'description' => '...',
					'lecturer' => 'Николай Бачийски',
				  ]
				];
			*/
            function showPage($data, $pageId) {
				
				$result;
				// Validate if the $data array contains key $pageId
				if (array_key_exists($pageId, $data)) {
					// get the course
					$course = $data[$pageId];

					// get title, description and lecturer and if they are not present use empty word
					$title = array_key_exists('title', $course) ? $course['title'] : "";
					$description = array_key_exists('description', $course) ? $course['description'] : "";
					$lecturer = array_key_exists('lecturer', $course) ? $course['lecturer'] : "";

					// build the result
					$result = "<h1>$title</h1><h2>$lecturer</h2><p>$description</p>";
				} else {
					$result = "<h1>Could not find course " . $pageId . ".</h1>";
				}

				return $result;
			}
			
			function showNav($data, $pageId) {
				
				// Validate if the $data array contains key $pageId
				$result = "<nav>";
				foreach($data as $key => $value) {
					$title = array_key_exists('title', $value) ? $value['title'] : "Could not find title";
					$result .= "<a href=\"?page=" . $key . "\"" . ($pageId != NULL && $key === $pageId ? " class=\"selected\">" : ">") . $title . "</a><br>";
				}	
				$result .= "</nav>";
				return $result;
			}
			
			$data = array('webgl' => array('title' => 'Компютърна графика с WebGL', 'description' => '...', 'lecturer' => 'доц. П. Бойчев'),
					          'go' => array('title' => 'Програмиране с Go', 'description' => '...', 'lecturer' => 'Николай Бачийски'));
							
			if(isset($_GET['page'])) {
				$pageId=$_GET['page'];
				echo showNav($data, $pageId);
				echo showPage($data, $pageId);
			} else {
				echo showNav($data, NULL); // default one
			}
        ?>
    </body>
</html>