<?php

namespace App\Components;

use ReflectionMethod;
use RuntimeException;
use InvalidArgumentException;

class DIContainer
{
    private static ?self $instance = null;

    private array $container = [];
    private array $config = [];

    /**
     * @param  array $config
     */
    private function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return void
     */
    private function __clone()
    {
        throw new RuntimeException('Cant clone');
    }

    public static function getInstance(array $config = [])
    {
        if (self::$instance === self::class) {
            return self::$instance;
        }

        self::$instance = new self($config);

        return self::$instance;
    }

    /**
     * @param  string $interface
     * @param  object $dependency
     * @return void
     */
    public function register(string $interface, object $dependency): void
    {
        $this->container[$interface] = $dependency;
    }

    /**
     * @param  string $className
     * @return object
     */
    public function build(string $className)
    {
        $config = $this->config;

        $constructorParams = [];

        $reflectionConstruct = new ReflectionMethod($className, '__construct');

        foreach($reflectionConstruct->getParameters() as $args) {
            $currClass = $args->getType()->getName();

            if(array_key_exists($currClass, $config) === false) {
                throw new InvalidArgumentException('Cannot instance constructor property');
            }

            if(array_key_exists($currClass, $this->container)) {
                $constructorParams[] = $this->container[$currClass];
                continue;
            }

            if(array_key_exists($currClass, $config)) {
                $this->container[$currClass] = new $config[$currClass];
                $constructorParams[] = $this->container[$currClass];
            }
        }

        return new $className(...$constructorParams);
    }
}
