# ValidatorFactory
Standalone library to use the Illuminate\\Validation package outside the Laravel framework.

## Installation
From your terminal, run:
```bash
$ composer require jeffochoa/validator-factory
```

## Usage

You need to create a new instance of the `ValidatorFactory` class.

```php
$factory = new JeffOchoa\ValidatorFactory();

$validator = $factory->make($data = [], $rules);
```
This will return an instance of `Illuminate\Validation\Validator::class`.

You can learn more about the *Laravel Validator* in the [official documentation website](https://laravel.com/docs/5.6/validation).

## Customizing error messages

You can specify a custom translation root directory

```php
$validator->translationsRootPath(__DIR__ . '/../../src/')
    ->make($data = [], $rules = ['foo' => 'required'])
```

Inside that directory you will need to create the following structure:

```
- lang/
  - en/
    - validation.php
```

You can customize the structure above by specifying the following values when you create a new instance of the `ValidatorFactory::class`

```php
$factory = new ValidatorFactory($namespace = 'lang', $lang = 'en', $group = 'validation');
```

If your plan is to use a custom rule object you would generally call the `trans` helper inside your `messages()` method when working inside of Laravel.
However you will not have access to the `trans` helper outside of Laravel so you will need to use `ValidatorFactory::trans($key)` instead.
