<?php

namespace ArrayUtils;


class ValidatorTest extends \PHPUnit_Framework_TestCase  {

    public function testValidator() {
        //Loader::load(Validator::class);

        $validator = new Validator();
        $validator
            //->addRule('c', 'required')
            //->addRule('a.b.c', 'required')
            //->addRule('d.e', 'required')
            //->addRule('f.x.*', 'numeric')
            //->addRule('w.x.*.a', 'required|numeric|max:5')
            //->addRule('y.*.a', 'required|numeric|max:5')
            //->addRule('*', 'required|numeric|max:5')
            ->addRule("a.b.*.c", 'present|required')
        ;

        $valores = [];

        for ($i = 0; $i < 10; $i++) {
            //$valores[] = ["a" => $i];
            $valores[] = $i;
        }

        //$ret = $validator->validate([
        //    'c' => 10,
        //    'a' => ['b' => 1],
        //    'd' => ['e' => []],
        //    'f' => ['x' => [1, 2, 3, '23x']],
        //    'w' => ['x' => [["a" => "1"], ["a" => "1"], ["a" => "20"]]],
        //    'y' => $valores
        //]);
        //$ret = $validator->validate($valores);

        $ret = $validator->validate(["a" => ["b" => [["c" => null]]]]);

        print_r($ret);

        $this->assertTrue(empty($ret));
    }
}
