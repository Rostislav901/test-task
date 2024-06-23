<?php

namespace App\Product\Application\Service;

class ProductMainFormatMapService
{
    public function __construct(
        private readonly CategoryMapService $categoryMapService,
        private readonly ImageMapService $imageMapService)
    {
    }

    public function getCategoryMapService(): CategoryMapService
    {
        return $this->categoryMapService;
    }

    public function getImageMapService(): ImageMapService
    {
        return $this->imageMapService;
    }
}
