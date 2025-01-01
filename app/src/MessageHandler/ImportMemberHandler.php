<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Builder\MemberBuilder;
use App\Message\ImportMember;
use App\Parser\MemberImportFileParser;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use League\Flysystem\FilesystemException;
use League\Flysystem\FilesystemOperator;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class ImportMemberHandler
{

    public function __construct(
        #[Autowire(service: 'oneup_flysystem.default_filesystem_filesystem')]
        private FilesystemOperator     $filesystem,
        private EntityManagerInterface $entityManager,
    ){}

    /**
     * @throws FilesystemException
     */
    #[NoReturn] public function __invoke(ImportMember $importMember): void
    {
        $stream = $this->filesystem->readStream($importMember->getFileName());
        $memberArray = MemberImportFileParser::parse(stream_get_meta_data($stream)['uri']);
        $memberObjects= [];


        foreach ($memberArray['value'] as $value) {
            $member = (new MemberBuilder($value))->buildMember();
            $memberObjects[]= $member;
            $this->entityManager->persist($member);
        }

        $this->entityManager->flush();
        dump($memberObjects[0]);
        die();
    }

}