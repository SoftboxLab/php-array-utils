<?php
/**
 * Created by PhpStorm.
 * User: tarcisio
 * Date: 15/06/17
 * Time: 14:56
 */

namespace PHP\Cast;

class ValidatorTest extends \PHPUnit_Framework_TestCase  {

    public function testValidator() {
        ArrayUtilsLoader::load(Validator::class);

        $validator = new Validator();
        $validator
            //->addRule('c', 'required')
            //->addRule('a.b.c', 'required')
            //->addRule('d.e', 'required')
            ->addRule('f.x.*', 'numeric')
            ->addRule('w.x.*.a', 'required|numeric|max:5')
            ->addRule('y.*.a', 'required|numeric|max:5')
        ;

        $valores = [];

        for ($i = 0; $i < 5; $i++) {
            $valores[] = ["a" => $i];
        }

        $ret = $validator->validate([
            'c' => 10,
            'a' => ['b' => 1],
            'd' => ['e' => []],
            'f' => ['x' => [1, 2, 3, '23x']],
            'w' => ['x' => [["a" => "1"], ["a" => "1"], ["a" => "20"]]],
            'y' => $valores
        ]);

        print_r($ret);

        $this->assertTrue(empty($ret));
    }
}
