--TEST--
Test is_literal() function
--FILE--
<?php

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

$non_literal_string = 'Foo' . strlen(__FILE__);

try {
    $result = literal_implode($non_literal_string, $pieces);
    echo "literal_implode failed to throw exception for non-literal glue.";
}
catch(TypeError $e) {
    echo $e->getMessage(), "\n";
}


$pieces = [$question_mark, $non_literal_string, $question_mark];

try {
    $result = literal_implode($glue, $pieces);
    echo "literal_implode failed to throw exception for non-literal piece.";
}
catch(TypeError $e) {
    echo $e->getMessage(), "\n";
}


echo "Done\n";

?>
--EXPECTF--
combined string: '?, ?, ?'
imploded string is correctly literal
glue must be literal string or int
Only literal strings and ints allowed. Found bad type at position %d
Done
