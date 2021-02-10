--TEST--
Test is_literal() function
--FILE--
<?php

$zok = 'zok';
$fot = 'fot';
$pik = 'pik';

literal_set($zok);
literal_set($fot);
literal_set($pik);

$result = literal_combine($zok, $fot, $pik);
$result_is_literal = is_literal($result);

if ($result_is_literal === true) {
    echo "Result of literal_combine is correctly a literal.\n";
}
else {
    echo "Result of literal_combine is NOT a literal.\n";
}

try {
    $non_literal_string =  $pik . " other string";
    literal_combine($zok, $fot, $non_literal_string);
    echo "literal_combine failed to throw exception for non-literal string.";
}
catch (TypeError $e) {
    echo $e->getMessage(), "\n";
}


try {
    literal_combine($zok, $fot, new StdClass);
    echo "literal_combine failed to throw exception for incorrect type.";
}
catch (TypeError $e) {
    echo $e->getMessage(), "\n";
}

echo "Done\n";

?>
--EXPECT--
Result of literal_combine is correctly a literal.
Non-literal string found at position, 1
Only literal strings, ints, bools allowed. Found at position, 1 bad type
Done
