<?php

if (!function_exists('assert_trait_class_compatibility')) {
    function assert_trait_class_compatiblity(string $trait, string $class, string $subclass, ?Throwable $e = null): bool
    {
        if (!is_subclass_of($class, $subclass)) {
            if ($e) {
                throw $e;
            }

            throw new Exception($trait . ' can only be applied to classes that inherits from ' . $subclass);
        }

        return true;
    };
}

if (!function_exists('assert_trait_interface_compatibility')) {
    function assert_trait_interface_compatiblity(string $trait, string $class, string $interface, ?Throwable $e = null): bool
    {
        if (!in_array($interface, class_implements($class))) {
            if ($e) {
                throw $e;
            }

            throw new Exception($trait . ' can only be applied to classes that implements ' . $interface);
        }

        return true;
    };
}
