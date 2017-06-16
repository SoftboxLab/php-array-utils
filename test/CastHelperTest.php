<?php

namespace ArrayUtils;


class CastHelperTest extends \PHPUnit_Framework_TestCase {

    private function getSample() {
        return [
            "a" => [
                "b" => [
                    "c1" => "a",
                    "c2" => "2",
                    "c3" => "3",
                    "c4" => ["1", "2", "3"],
                    "c5" => [
                        ["d1" => "9"],
                        ["d1" => "8"],
                        ["d1" => "7"],
                    ]
                ]
            ]
        ];
    }
    public function testSimpleCast() {
        $value = $this->getSample();

        $ret = (new CastHelper())
            ->addRule("a.b.c1", "string")
            ->addRule("a.b.c2", "int")
            ->addRule("a.b.c3", "float")
            ->addRule("a.b.c4.*", "int")
            ->addRule("a.b.c5.*.d1", "string|lpad:2,0")
            ->cast($value);

        $this->assertEquals($ret["a"]["b"]["c1"] === "a");
        $this->assertEquals($ret["a"]["b"]["c2"] === 2);
        $this->assertEquals($ret["a"]["b"]["c3"] === 3.0);
        $this->assertEquals($ret["a"]["b"]["c4"][0] === 1);
        $this->assertEquals($ret["a"]["b"]["c4"][1] === 2);
        $this->assertEquals($ret["a"]["b"]["c4"][2] === 3);
        $this->assertEquals($ret["a"]["b"]["c5"][0]["d1"] === "09");
        $this->assertEquals($ret["a"]["b"]["c5"][0]["d1"] === "08");
        $this->assertEquals($ret["a"]["b"]["c5"][0]["d1"] === "07");
    }
}
