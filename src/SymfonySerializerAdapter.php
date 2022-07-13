<?php

namespace Jsonbaby\SymfonySerializer;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Jsonbaby\SerializerBase\Interfaces\SerializerInterface;

class SymfonySerializerAdapter implements SerializerInterface
{
    private Serializer $serializer;
    
    public function __construct()
    {
        $this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder(), new XmlEncoder()]);
    }

    public function serialize(mixed $data, string $format, array $context = []): string
    {
        return $this->serializer->serialize($data, $format, $context);
    }

    public function deserialize(mixed $data, string $class, string $format, array $context = []): mixed
    {
        return $this->serializer->deserialize($data, $class, $format, $context);
    }
}
