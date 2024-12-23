<?php

declare(strict_types=1);

namespace App\Dto;

use Symfony\Component\HttpFoundation\File\File;

class ImportMemberInput
{

    public ?string $name = null;

    public ?File $file = null;
}