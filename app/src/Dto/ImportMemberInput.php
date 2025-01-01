<?php

declare(strict_types=1);

namespace App\Dto;

use ApiPlatform\Metadata\ApiProperty;
use Symfony\Component\HttpFoundation\File\UploadedFile as File;
class ImportMemberInput
{
    #[ApiProperty(
        description: 'name of import file',
        openapiContext: [
            'type' => 'string',
            'example' => 'John Doe'
        ]
    )]
    public ?string $name = null;

    #[ApiProperty(
        description: 'File for members import',
        openapiContext: [
            'type' => 'file'
        ]
    )]
    public ?File $file = null;
}