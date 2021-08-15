<?php
$start = strtotime("15-8-2021");
$end = strtotime("20-08-2021");
$ec = ceil(($end - $start) / 60 / 60 / 24);
echo $ec;
