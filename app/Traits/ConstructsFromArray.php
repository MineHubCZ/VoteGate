<?php

namespace App\Traits;

use Exception;

trait ConstructsFromArray
{
    /**
     * If the given $data array keys don't match class' properties, throws an exception.
     * Otherwise creates new instance of the class, based on the $data, and returns it.
     *
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self {
        $properties_names = array_keys(get_class_vars(self::class));

        if (count(array_intersect($properties_names, array_keys($data))) != count($properties_names)) {
            throw new Exception("Given \$data array is incompatible with ".self::class." class' properties.");
        }

        return new self(...$data);
    }
}
