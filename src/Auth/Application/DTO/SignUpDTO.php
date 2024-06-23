<?php

namespace App\Auth\Application\DTO;

use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class SignUpDTO
{
    #[OA\Property(property: 'email', description: 'User email', type: 'string', format: 'format-email', example: 'user@example.com')]
    #[NotBlank]
    #[Email]
    public string $email;

    #[OA\Property(property: 'password', description: 'User password', type: 'string', maxLength: 50, minLength: 3, example: 'P@ssw0rd')]
    #[NotBlank]
    #[Length(min: 3, max: 50)]
    public string $password;
    #[OA\Property(property: 'confirmPassword', description: 'Equal to password', type: 'string', maxLength: 50, minLength: 3, example: 'P@ssw0rd')]
    #[NotBlank]
    #[Length(min: 3, max: 50)]
    #[EqualTo(propertyPath: 'password', message: 'The passwords must match')]
    public string $confirmPassword;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getConfirmPassword(): string
    {
        return $this->confirmPassword;
    }

    public function setConfirmPassword(string $confirmPassword): void
    {
        $this->confirmPassword = $confirmPassword;
    }
}
