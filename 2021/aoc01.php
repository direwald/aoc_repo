<?php

// Input processing

$file = file_get_contents(__DIR__.'/inputs/input20210112.csv');

$array = preg_split("/(\r\n|\n|\r)(\r\n|\n|\r)/", $file);

$input_array = array();

// foreach ($array as $arr) {
//     $elf_array = preg_split("/\r\n|\n|\r/", $arr);
//     array_push($input_array, $elf_array);
// }

$base_measuremnt = $array[0];
$increased = 0;

foreach ($array as $measurement) {
    if ($measurement > $base_measuremnt) {
        $increased++;
    }
    $base_measuremnt = $measurement;
}

echo $increased;

// part 2

$increased = 0;

$two_measure_sum = $array[0] + $array[1] + $array[2];

foreach ($array as $key => $measure) {
    if (isset($array[$key-2])) {
        $one_measure_sum = $array[$key] + $array[$key-1] + $array[$key-2];
    }
    if (isset($one_measure_sum)) {
        if ($one_measure_sum > $two_measure_sum) {
            $increased++;
        }
        $two_measure_sum = $one_measure_sum;
    }
}

echo '<br>'.$increased;
