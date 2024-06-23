<?php

namespace App\Shared\Application\ArgumentResolver;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractRequestArgumentResolver implements ValueResolverInterface
{
    public function __construct(protected readonly SerializerInterface $serializer, protected readonly ValidatorInterface $validator)
    {
    }

    abstract public function resolve(Request $request, ArgumentMetadata $argument): iterable;
}
