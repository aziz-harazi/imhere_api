<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\ImportMember;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class ImportMemberHandler
{

    public function __invoke(ImportMember $importMember): void
    {
        dump($importMember);
    }

}