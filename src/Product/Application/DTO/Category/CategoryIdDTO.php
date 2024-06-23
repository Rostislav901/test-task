<?php

namespace App\Product\Application\DTO\Category;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class CategoryIdDTO
{
    public function __construct(
        #[NotBlank]
        #[Regex(pattern: '/^[0-9\s]{1,}$/', message: 'id must be a number')]
        public string $id,
    ) {
    }
}
