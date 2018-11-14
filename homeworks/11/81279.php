<!DOCTYPE html>
<html>
    <head>
        <title>Homework 1.1</title>
		<style>
			tr.times td.colored {
				color: blue;
			}
			
			table, tr.times, tr.times th, tr.times td.colored {
				border: 2px solid black;
				border-collapse: collapse;
			}
			
			tr.times td, tr.times th {
				text-align: center;
				width: 20px;
				height: 20px;
			}	
		</style>
    </head>
    <body>
        <table>
            <?php
                $LIMIT = 9;
                for ($i = 1; $i <= $LIMIT; $i++) {
                    echo "<tr class=\"times\">";
                    for ($j = 1; $j <= $LIMIT; $j++) {
                        $v = $i * $j;
                        if ($i === 1 || $j === 1) {
                            echo "<th>$v</th>";
                        } else {
                            echo "<td class=colored>$v</td>";
                        }
                    }
                    echo "</tr>";
                }
            ?>
        </table>
    </body>
</html>