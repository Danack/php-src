<?php

declare(strict_types = 1);


if (function_exists('is_literal') !== true) {
    echo "is_literal is not a function.\n";
    exit(-1);
}

echo "function exists at least.\n";
$value = "Hello there!";

foo("bar");

$string_is_literal = is_literal($value);

echo "string_is_literal is " . var_export($string_is_literal, true). "\n";

$rand_is_literal = is_literal(rand(10, 20));

echo "rand_is_literal is " . var_export($rand_is_literal, true). "\n";


$tokens = token_get_all(file_get_contents(__FILE__));

$count = 0;

foreach ($tokens as $token) {

    $count += 1;

    if ($count < 40) {
        continue;
    }

    if (is_array($token)) {
        echo "Line {$token[2]}: ", token_name($token[0]), " ('{$token[1]}')", PHP_EOL;
    }


    if ($count > 55) {
        exit(0);
    }
}
