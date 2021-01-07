<?php

namespace Rayblair\ArrayToObject\Tests;

use Orchestra\Testbench\TestCase;
use Rayblair\ArrayToObject\ArrayToObject;

class ArrayToObjectTest extends TestCase
{
    /**
     * Test our ArrayToObject helper function
     *
     * @return void
     */
    public function testArrayToObject()
    {
        $array = [
            'foo' => 'bar',
            'level1' => [
                'level1_key' => 'level1_value',
                'level2' => [
                    'level2_key' => 'level2_value',
                    'level3' => [
                        'level3_key' => 'level3_value',
                    ],
                ],
            ]
        ];

        // Assert we have an array
        $this->assertIsArray($array);

        // Assert our array has the array key
        $this->assertArrayHasKey('foo', $array);

        $object = ArrayToObject::convert($array);

        // Assert our new return isn't an array
        $this->assertTrue(!is_array($object));

        // Assert our new return is an object
        $this->assertIsObject($object);

        // Assert our object has the property foo
        $this->assertObjectHasAttribute('foo', $object);

        // Assert our object has the nested properties
        // LEVEL 1 NESTED
        $this->assertObjectHasAttribute('level1', $object);
        $this->assertObjectHasAttribute('level1_key', $object->level1);
        // LEVEL 2 NESTED
        $this->assertObjectHasAttribute('level2', $object->level1);
        $this->assertObjectHasAttribute('level2_key', $object->level1->level2);
        // LEVEL 3 NESTED
        $this->assertObjectHasAttribute('level3', $object->level1->level2);
        $this->assertObjectHasAttribute('level3_key', $object->level1->level2->level3);
    }
}
