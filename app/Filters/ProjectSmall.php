<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class ProjectSmall implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(300, 169);
    }
}