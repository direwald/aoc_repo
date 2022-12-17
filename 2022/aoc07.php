<?php

// Input processing

$file = file_get_contents(__DIR__ . '/inputs/input20220712.csv');

$input = $file;

// Part 1
// Input is a series of commands that go through folder directories. Calculate, which folders
// have size at most 100000 and add them together

print_r($input);

