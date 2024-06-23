<?php

namespace App\Product\Application\Service;

use App\Product\Application\DTO\Product\ImageItemDTO;

class ImageMapService
{
    /**
     * @param ImageItemDTO[] $images
     */
    public function mapImageToProductFormat(array $images): array
    {
        return array_map(
            fn (ImageItemDTO $imageItemDTO) => $imageItemDTO->image,
            $images
        );
    }
}
