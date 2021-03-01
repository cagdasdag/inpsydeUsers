<?php

declare(strict_types=1);

namespace InpsydeUsers;

class Autoload
{
    protected $classLoader;

    /**
     * Autoload constructor. Load and run constructor of all classes.
     */
    public function __construct()
    {
        $autoInstances = [
            'Admin' => Admin::class,
            'Front' => Front::class,
            'Endpoint' => Endpoint::class,
            'Assets' => Assets::class,
        ];
        foreach ($autoInstances as $className => $class) {
            $this->classLoader[ $className ] = new $class();
        }
    }
}
