<?php
echo "<h1>Task 1 (8/8/2021)</h1>";
$first_num = 15;
$second_num = 5;

$operator = "Division";

switch ($operator) {
        // Code ...
    case "Addition":
        $result = $first_num + $second_num;
        break;

    case "Subtraction":
        $result = $first_num - $second_num;
        break;

    case "Multiplication":
        $result = $first_num * $second_num;
        break;

    case "Division":
        $result = $first_num / $second_num;
        break;
}
echo "<h3>The Result For " . $operator . " is = " .  $result . '</h3>';
