<?php

namespace App\Shared\Application\ArgumentResolver;

use App\Shared\Application\Attribute\RequestBody;
use App\Shared\Application\Exception\RequestBodyConvertException;
use App\Shared\Application\Exception\ValidationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class RequestBodyRawArgumentResolver extends AbstractRequestArgumentResolver
{
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        if (!$argument->getAttributesOfType(RequestBody::class, ArgumentMetadata::IS_INSTANCEOF)) {
            return [];
        }

        try {
            $model = $this->serializer->deserialize(
                $request->getContent(),
                $argument->getType(),
                JsonEncoder::FORMAT,
            );
        } catch (\Throwable $throwable) {
            echo $throwable->getMessage();
            throw new RequestBodyConvertException($throwable);
        }
        $errors = $this->validator->validate($model);
        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }

        return [$model];
    }
}
