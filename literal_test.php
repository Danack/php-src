<?php

declare(strict_types = 1);


$glue = ', ';
$question_mark = '?';

literal_set($glue);
literal_set($question_mark);

$pieces = [$question_mark, $question_mark, $question_mark];

$result = literal_implode($glue, $pieces);

echo "imploded string: '$result'\n";

if (is_literal($result) === true) {
    echo "imploded string is correctly literal\n";
}
else {
    echo "imploded string is NOT literal\n";
}
