<?php

namespace Jsonbaby\SymfonySerializer\Tests\Stubs;

class ExampleClass
{
    const TEST = 'Test CONST';

    public function __construct(private string $foo, public string $bar)
    {
    }

    public function getFoo(): string
    {
        return $this->foo;
    }

    public function fooArray(): array
    {
        return [
            'foo' => $this->getFoo(),
            'bar' => $this->bar,
            'test' => self::TEST
        ];
    }
}
