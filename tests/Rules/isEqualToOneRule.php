<?php
namespace JeffOchoa\Tests\Rules;

use JeffOchoa\ValidatorFactory;
use Illuminate\Contracts\Validation\Rule;


class isEqualToOneRule implements Rule
{
    public function passes($attribute, $value) {
        if($value !== 1)
            return false;

        return true;
    }

    public function message()
    {
        $key = 'validation.custom.isequaltoone';

        return ValidatorFactory::$translator->trans($key);
    }
}