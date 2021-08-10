<?php
// Task
// Write a PHP program to calculate electricity bill .
// Conditions:
// For first 50 units  ----- 3.50/unit
// For next 100 units  ----- 4.00/unit
// For units above 150 ----- 6.50/unit
// You can use conditional statements.

function calculate_electricity_bill($units)
{
    $first_unit_cost = 3.50;  // For first 50 units
    $second_unit_cost = 4.00; // For next 100 units
    $third_unit_cost = 6.50;  // For units above 150

    if ($units <= 50) {

        $bill = $units * $first_unit_cost;
    } else if ($units > 50 && $units <= 150) {

        $temp = 50 * $first_unit_cost;

        $remaining_units = $units - 50;

        $bill = $temp + ($remaining_units * $second_unit_cost);
    } else {

        $temp = (50 * $first_unit_cost) + (100 * $second_unit_cost);

        $remaining_units = $units - 150;

        $bill = $temp + ($remaining_units * $third_unit_cost);
    }
    return number_format((float)$bill, 2, '.', ''); // ($num , $decimals , $decimal_separator , $thousands_separator)
}
echo calculate_electricity_bill(50); //  (50) Static Value
