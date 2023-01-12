<?php

namespace App\Traits;

trait EmailRule
{
    public function email(string $key, string $value = null)
    {
        if (!empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return 'The '. $key . ' field is not valid. Please input a valid email';
        }
    }
}
