<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class ProjectPromo implements FilterInterface
{
    public function applyFilter(Image $image)
    {
        return $image->fit(1260, 708);
    }
}