<?php

namespace App\Traits;

trait NumberRule
{
    public function number(string $key, string $value = null)
    {
        if(!preg_match('/^([0-9]*)$/', $value)) {
            return 'The '. $key . " field is an invalid number";
        }
    }
}
