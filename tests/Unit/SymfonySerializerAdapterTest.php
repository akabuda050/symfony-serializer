<?php

namespace Jsonbaby\SymfonySerializer\Tests;

use Jsonbaby\SymfonySerializer\SymfonySerializerAdapter;
use Jsonbaby\SymfonySerializer\Tests\Stubs\ExampleClass;
use PHPUnit\Framework\TestCase;

class SymfonySerializerAdapterTest extends TestCase
{
    /** @test */
    public function it_serialize_class()
    {
        $exampleClass = new ExampleClass('Example Class private property', 'Bar Example');

        $serializerAdapter = new SymfonySerializerAdapter();

        $jsonSerialized = $serializerAdapter->serialize($exampleClass, 'json');
        $xmlSerialized = $serializerAdapter->serialize($exampleClass, 'xml');

        self::assertIsString($jsonSerialized);
        self::assertIsString($xmlSerialized);

        self::assertStringContainsString('Example Class private property', $jsonSerialized);
        self::assertStringContainsString('Bar Example', $jsonSerialized);

        self::assertStringContainsString('Example Class private property', $xmlSerialized);
        self::assertStringContainsString('Bar Example', $xmlSerialized);
    }

    /** @test */
    public function it_deserialize_class_in_json()
    {
        $exampleClass = new ExampleClass('Example Class private property', 'Bar Example');
        
        $serializerAdapter = new SymfonySerializerAdapter();

        $jsonSerialized = $serializerAdapter->serialize($exampleClass, 'json');
        
        /** @var ExampleClass $jsonDeserialized */
        $jsonDeserialized = $serializerAdapter->deserialize($jsonSerialized, ExampleClass::class, 'json');

        self::assertInstanceOf(ExampleClass::class, $jsonDeserialized);

        $fooArray = $jsonDeserialized->fooArray();

        self::assertArrayHasKey('foo', $fooArray);
        self::assertArrayHasKey('bar', $fooArray);
        self::assertArrayHasKey('test', $fooArray);

        self::assertSame('Example Class private property', $fooArray['foo']);
        self::assertSame('Bar Example', $fooArray['bar']);
        self::assertSame('Test CONST', $fooArray['test']);
    }

    /** @test */
    public function it_deserialize_class_in_xml()
    {
        $exampleClass = new ExampleClass('Example Class private property', 'Bar Example');

        $serializerAdapter = new SymfonySerializerAdapter();

        $xmlSerialized = $serializerAdapter->serialize($exampleClass, 'xml');

        /** @var ExampleClass $xmlDeserialized */
        $xmlDeserialized = $serializerAdapter->deserialize($xmlSerialized, ExampleClass::class, 'xml');

        self::assertInstanceOf(ExampleClass::class, $xmlDeserialized);

        $fooArray = $xmlDeserialized->fooArray();

        self::assertArrayHasKey('foo', $fooArray);
        self::assertArrayHasKey('bar', $fooArray);
        self::assertArrayHasKey('test', $fooArray);

        self::assertSame('Example Class private property', $fooArray['foo']);
        self::assertSame('Bar Example', $fooArray['bar']);
        self::assertSame('Test CONST', $fooArray['test']);
    }
}