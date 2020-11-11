<?php

require 'vendor/autoload.php';

echo 'enter snail\'s width:';
$handle = STDIN;
$width = trim(fgets($handle));

// fgets issued an error or typed value is not an integer
if (!$width || $width < 1 || !ctype_digit((string) $width)) {
    exit ('please enter a valid integer'.PHP_EOL);
}
$snail = new Snail($width);

$snail->draw();
