<?php
echo '<table width="570px" cellspacing="0px" cellpadding="0px" border="1px">';
for ($row = 1; $row <= 8; $row++) {
    echo "<tr>";
    for ($col = 1; $col <= 8; $col++) {
        $count = $row + $col;
        if ($count % 2 == 0) {
            echo "<td height=60px width=60px bgcolor=#FFFFFF></td>";
        } else {
            echo "<td height=60px width=60px bgcolor=#000000></td>";
        }
    }
    echo "</tr>";
}
echo '</table>';


// Echo Multidimensional Array

$students = array(

    array("20130", "ahmed", 3.4),
    array("20131", "Root", 3.8),
    array("20132", "Test", 4.00)
);

// for ($row = 0; $row < count($students); $row++) {
//     echo "<p><b>Row number $row</b></p>";
//     echo "<ul>";
//     for ($col = 0; $col < count($students[$row]); $col++) {
//         echo "<li>" . $students[$row][$col] . "</li>";
//     }
//     echo "</ul>";
// }

// Other Soulation 

foreach ($students as $row => $student) {
    echo "<p><b>Row number $row</b></p>";
    echo "<ul>";
    foreach ($student as $value) {
        echo "<li>" . $value . "</li>";
    }
    echo "</ul>";
}
