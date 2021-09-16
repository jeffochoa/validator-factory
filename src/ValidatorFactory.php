<?php

namespace JeffOchoa;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;

class ValidatorFactory
{
    public string $lang;

    public string $group;

    public Factory $factory;

    public string $namespace;

    /**
     * Translations root directory.
     *
     * @var string
     */
    public string $basePath;

    public static ?Translator $translator = null;

    public function __construct(string $namespace = 'lang', string $lang = 'en', string $group = 'validation')
    {
        $this->lang      = $lang;
        $this->group     = $group;
        $this->namespace = $namespace;
        $this->basePath  = $this->getTranslationsRootPath();
        $this->factory   = new Factory($this->loadTranslator());
    }

    /**
     * @param string $path
     *
     * @return static
     */
    public function translationsRootPath(string $path = ''): static
    {
        if (!empty($path)) {
            $this->basePath = $path;
            $this->reloadValidatorFactory();
        }

        return $this;
    }

    /**
     * @return static
     */
    private function reloadValidatorFactory(): static
    {
        $this->factory = new Factory($this->loadTranslator());

        return $this;
    }

    /**
     * @return string
     */
    public function getTranslationsRootPath() : string
    {
        return dirname(__FILE__) . '/';
    }

    /**
     * @return Translator
     */
    public function loadTranslator() : Translator
    {
        $loader = new FileLoader(new Filesystem(), $this->basePath . $this->namespace);
        $loader->addNamespace($this->namespace, $this->basePath . $this->namespace);
        $loader->load($this->lang, $this->group, $this->namespace);

        return static::$translator = new Translator($loader, $this->lang);
    }

    public function __call($method, $args)
    {
        return call_user_func_array([$this->factory, $method], $args);
    }
}
