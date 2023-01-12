<?php

namespace App\Traits;

trait AlphaRule
{
    public function alpha(string $key, string $value = null)
    {
        if(!preg_match('/^[a-zA-Z\s]+$/', $value)){
            return 'The '. $key . ' field must use just the letters a-z or A- Z';
        }
    }
}
