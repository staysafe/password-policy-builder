<?php

use PHPUnit\Framework\TestCase;

final class ArrayPolicyTest extends TestCase{

    function test_empty_array(){

        $emptyArray = [];

        self::assertEmpty($emptyArray);

    }
}