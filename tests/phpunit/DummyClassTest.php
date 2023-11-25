<?php

namespace StaySafe\Password\Policy\Test;

use StaySafe\Password\Policy\DummyClass;
use PHPUnit\Framework\TestCase;

class DummyClassTest extends TestCase
{

    /**
     * @test
     */
    function test_that_the_cake_bakes()
    {

        $cake = new DummyClass(45);

        $bakedCake = $cake->bake(['eggs', 'milk', 'flour', 'sugar']);

        self::assertEquals('Baking eggs, milk, flour, sugar at 45', $bakedCake);

    }


}