--TEST--
Test is_literal() function
--FILE--
<?php
if (is_literal('Foo') === true) {
    echo "string as parameter is literal\n";
}
else {
    echo "string as parameter is NOT literal\n";
}

$string = 'Foo 2';
if (is_literal($string) === true) {
    echo "string as variable is literal\n";
}
else {
    echo "string as variable is NOT literal\n";
}

echo "Done\n";


?>
--EXPECT--
string as parameter is literal
string as variable is literal
Done
