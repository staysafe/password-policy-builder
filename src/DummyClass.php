<?php

namespace StaySafe\Password\Policy;

class DummyClass
{

    private int $temperature;

    function __construct($temperature)
    {
        $this->temperature = $temperature;
    }

    function bake($ingredients): string
    {

        return 'Baking ' . $this->prepare($ingredients) . ' at ' . $this->temperature;

    }

    /**
     * @param array $ingredients
     * @return string
     */
    function prepare(array $ingredients): string
    {

        $mixture = implode(", ", $ingredients);

        return $mixture;

    }

}