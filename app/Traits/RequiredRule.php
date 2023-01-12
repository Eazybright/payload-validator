<?php

namespace  App\Traits;

trait RequiredRule
{
    public function required(string $key, string $value = null)
    {
        if(empty($value)){
            return 'The '. $key . ' field is required';
        }
    }
}
