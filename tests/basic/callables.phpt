
<?php

//--TEST--
//Consistent callables
//--FILE--
//

function normalFunction()
{

}


class CallableTest {

    public $callable;

    public $is_callable_in_7_4;
    public $is_callable_in_8_x;
    public $is_callable_type;

    /**
     * CallableTest constructor.
     * @param $callable
     * @param $is_callable_in_7_4
     * @param $is_callable_in_8_x
     * @param $is_callable_type
     */
    public function __construct($callable, $is_callable_in_7_4, $is_callable_in_8_x, $is_callable_type)
    {
        $this->callable = $callable;
        $this->is_callable_in_7_4 = $is_callable_in_7_4;
        $this->is_callable_in_8_x = $is_callable_in_8_x;
        $this->is_callable_type = $is_callable_type;
    }
}




class Normal {

    private function privateMethod() {

    }
    public function publicMethod() {

    }

    public static function publicStaticMethod() {

    }

    private static function privateStaticMethod() {

    }
}

class MagicStaticCall {
    public static function __callStatic($name, $arguments) {

    }
}


class MagicCall {
    public function __call($name, $arguments) {

    }
}

class Invokable {

    public function __invoke()
    {
        return 4;
    }
}

$normal = new Normal();
$magicCall = new MagicCall();
$invokable = new Invokable();


//$badCallables = [
//    ['Normal', 'publicMethod'],
//    [$normal, 'privateMethod'],
//    ['Normal', 'privateStaticMethod'],
//    'Normal::privateStaticMethod',
//];
//
//$fn = function () {
//    return 4;
//};

//foreach ($badCallables as $badCallable) {
//    $result = is_callable($badCallable);
//    if ($result !== false) {
//        var_dump($result);
//        echo "Fail checking badCallable: " . var_dump($badCallable). "\n";
//    }
//}


// callable - is_callable in 7.4, is_callable in 8, is_callable_type
$allowedCallables = [

    // string name of a function.
    new \CallableTest('normalFunction', true, true, true),

    // public method
    new \CallableTest([$normal, 'publicMethod'], true, true, true),

    // public static method
    new \CallableTest(['Normal', 'publicStaticMethod'], true, true, true ),

    // public static method
    new \CallableTest('Normal::publicStaticMethod',true, true, true),

    // Class with __callStatic
    new \CallableTest(['MagicStaticCall', 'noneExistentMethod'], true, true, true ),

    // Class with __callStatic),
    new \CallableTest('MagicStaticCall::noneExistentMethod', true, true, true),

    // invokable
    new \CallableTest($invokable, true, true, true),

    // closure
    new \CallableTest($fn, true, true, true),
];


//foreach ($allowedCallables as $allowedCallable) {
//    $is_callable_result = is_callable($allowedCallable);
//
//
//
//
//    if ($is_callable_result !== true) {
//        var_dump($result);
//        echo "Fail checking allowedCallable: " . var_dump($allowedCallable). "\n";
//    }
//
//    // is_callable_type
//}



class A {
    public function bar() {
        return 'A';
    }

    public function passStaticBarDirectly() {
        $callable = 'static::bar';
        return $this->executeDirectly($callable);
    }

    public function passSelfBarDirectly() {
        $callable = 'self::bar';
        return $this->executeDirectly($callable);
    }

    public function passStaticBarCuf() {
        $callable = 'static::bar';
        return $this->executeWithCUF($callable);
    }

    public function passSelfBarCuf() {
        $callable = 'self::bar';
        return $this->executeWithCUF($callable);
    }

    private function executeDirectly($callable) {
        return $callable();
    }

    private function executeWithCUF($callable) {
        return call_user_func($callable);
    }
}

class B extends A {
    public function bar() {
        return 'B';
    }

    public function passParentBar() {
        $callable = 'parent::bar';
        $this->executeDirectlyInB($callable);
    }

    public function passParentBarAltSyntax() {
        $callable = [$this, 'parent::bar'];
        $this->executeDirectlyInB($callable);
    }

    private function executeDirectlyInB(callable $callable) {
        return $callable();
    }

    private function executeWithCUFInB(callable $callable) {
        return call_user_func($callable);
    }

}

$a = new A();
$b = new B();

//$result = $a->passSelfBarDirectly();
//if ($result !== 'A') {
//    echo "Error";
//}

$result = $a->passSelfBarCuf();
if ($result !== 'A') {
    echo "Error";
}



exit(0);



// Add function is_callable_type - 7.4
// Add deprecation notices for self and parent usage in string based callable types e.g. 'self::foo' - 7.4
// Add deprecation notices for deprecation notices for self and parent usage in array based callable types e.g. array('B', 'parent::who') - 7.4



//The strings 'self', 'parent', and 'static' are no longer usable as part of a string callable

//--EXPECT--
//
//shamoan

?>

