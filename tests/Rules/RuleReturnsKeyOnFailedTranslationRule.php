<?php
namespace JeffOchoa\Tests\Rules;

use Illuminate\Contracts\Validation\Rule;
use JeffOchoa\ValidatorFactory;

class RuleReturnsKeyOnFailedTranslationRule implements Rule
{
    public function passes($attribute, $value)
    {
        if ($value !== 1) {
            return false;
        }

        return true;
    }

    public function message()
    {
        $key = 'validation.custom.notexist';

        return ValidatorFactory::$translator->get($key);
    }
}
