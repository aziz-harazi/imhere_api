<?php

declare(strict_types=1);

namespace App\Message;

use Symfony\Component\Messenger\Attribute\AsMessage;

#[AsMessage('async')]
class ImportMember
{

    public function __construct(private string $fileName)
    {

    }

    public function getFileName(): string
    {
        return $this->fileName;
    }
}