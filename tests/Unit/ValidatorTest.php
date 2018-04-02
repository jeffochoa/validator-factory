<?php

namespace JeffOchoa\Tests\Unit;

use JeffOchoa\Tests\TestCase;
use JeffOchoa\ValidatorFactory;

class ValidatorTest extends TestCase
{
    /** @test */
    public function check_data_format_validation()
    {
        $validator = new ValidatorFactory();

        $data = [
            'foo' => 'bar'
        ];

        $rules = [
            'baz' => 'required|url'
        ];

        $validator = $validator->make($data, $rules);
        $errors = $validator->errors()->toArray();

        $this->assertTrue($validator->fails());
        $this->assertEquals('The baz field is required.', $errors['baz'][0]);
    }

    /** @test */
    public function returns_dot_notation_route_to_error_message_if_validation_directory_is_not_found()
    {
        $validator = new ValidatorFactory();

        $result = $validator->translationsRootPath('some/custom/path')
            ->make($data = [], $rules = ['foo' => 'required']);
        $errors = $result->errors()->ToArray();

        $this->assertEquals('validation.required', $errors['foo'][0]);
    }

    /** @test */
    public function allow_custom_translation_directories()
    {
        $validator = new ValidatorFactory();

        $result = $validator->translationsRootPath(__DIR__ . '/../../src/')
            ->make($data = [], $rules = ['foo' => 'required']);
        $errors = $result->errors()->ToArray();


        $this->assertEquals('The foo field is required.', $errors['foo'][0]);
    }
}
