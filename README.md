# PHP-CAST
[![Build Status](https://travis-ci.org/tarcisiojr/php-cast.svg?branch=master)](https://travis-ci.org/tarcisiojr/php-cast)
[![codecov](https://codecov.io/gh/tarcisiojr/php-cast/branch/master/graph/badge.svg)](https://codecov.io/gh/tarcisiojr/php-cast)
[![Latest Stable Version](https://poser.pugx.org/tarcisiojr/php-cast/v/stable)](https://packagist.org/packages/tarcisiojr/php-cast)
[![Total Downloads](https://poser.pugx.org/tarcisiojr/php-cast/downloads)](https://packagist.org/packages/tarcisiojr/php-cast)
[![Latest Unstable Version](https://poser.pugx.org/tarcisiojr/php-cast/v/unstable)](https://packagist.org/packages/tarcisiojr/php-cast)
[![composer.lock](https://poser.pugx.org/tarcisiojr/php-cast/composerlock)](https://packagist.org/packages/tarcisiojr/php-cast)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/f4c39a14-b982-42d4-bd35-90bf660dc49a/mini.png)](https://insight.sensiolabs.com/projects/f4c39a14-b982-42d4-bd35-90bf660dc49a)

Helps to cast values of array of array. Util when it is necessary garantee the type of output value, por exemple, 
encoding of arrays in JSON. Beyond cast values, it is possible format too.

## Installation

```
composer require tarcisiojr/php-cast
```

## Usage

Example:

```php
class Example {
    public function test() {
        $value = [
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
    
        // 1. Create a instance of CastHelper
        // 2. Configure the rules to cast values
        // 3. Execute method 'cast' to cast array values
        
        $ret = (new CastHelper())
            ->addRule("a.b.c1", "string")
            ->addRule("a.b.c2", "int")
            ->addRule("a.b.c3", "float")
            ->addRule("a.b.c4.*", "int")
            ->addRule("a.b.c5.*.d1", "string|lpad:2,0")
            ->cast($value);

        echo "\n\n" . json_encode($ret, JSON_PRETTY_PRINT);
    }
}

```

Output:

```
{
    "a": {
        "b": {
            "c1": "a",
            "c2": 2,
            "c3": 3,
            "c4": [
                1,
                2,
                3
            ],
            "c5": [
                {
                    "d1": "09"
                },
                {
                    "d1": "08"
                },
                {
                    "d1": "07"
                }
            ]
        }
    }
}
```

### Path Expression

* a.b selects "value": 
```php
    [ 
        "a" => [
            "b" => "value"
        ]
    ]; 
```

* a.2.b selects "two": 
```php
    [ 
        "a" => [
            [ "b" => "zero" ],
            [ "b" => "one" ],
            [ "b" => "two" ],
            [ "b" => "three" ]
        ]
    ]; 
```

* a.*.b selects all values "zero, "one", "two" and "three": 
```php
    [ 
        "a" => [
            [ "b" => "zero" ],
            [ "b" => "one" ],
            [ "b" => "two" ],
            [ "b" => "three" ]
        ]
    ]; 
```


### Rule Expression

Expression: cast_type|option_1:param_1,param_2,...param_n;option_2:param_1...;option_n... 

Where cast_type is the identifier of cast rule, options are aditional configurations do be executed against the value, for example, trim, pad, etc.

Cast Types:

* int: casts to a int value.
* float: casts to a float point value.
* bool: casts to a boolean value.
* string: casts to a string value.
    - max_length:size truncate the value at max length.
    - rpad:size,char pad at right position with supplied char.
    - lpad:size,char pad at left position with supplied char.

## Extending

It is possible to add new cast rules, for this it will be necessary create a class the extends ```CastRule``` interface 
and register it with ```PHP\Cast\CastRule\CastRuleFactory::registerCastRule``` method. You can use the 
```PHP\Cast\CastRule\CastRuleBase``` to shorten the path. See example above:

```php
class BooleanCastRule extends PHP\Cast\CastRule\CastRuleBase {
    public function getIdentifier() {
        return "bool";
    }

    public function cast($value) {
        return (boolean) $value;
    }
} 

...

PHP\Cast\CastRule\CastRuleFactory::registerCastRule(new BooleanCastRule());

...
```
