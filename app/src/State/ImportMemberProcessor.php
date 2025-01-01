<?php
declare(strict_types=1);

namespace App\State;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Post;
use ApiPlatform\State\ProcessorInterface;
use ApiPlatform\Metadata\DeleteOperationInterface;
use ApiPlatform\Metadata\Operation;
use App\Dto\ImportMemberInput;
use App\Entity\User;
use App\Message\ImportMember;
use League\Flysystem\FilesystemException;
use League\Flysystem\FilesystemOperator;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class ImportMemberProcessor implements ProcessorInterface
{
    public function __construct(
        #[Autowire(service: 'api_platform.doctrine.orm.state.persist_processor')]
        private ProcessorInterface           $persistProcessor,
        #[Autowire(service: 'api_platform.doctrine.orm.state.remove_processor')]
        private ProcessorInterface           $removeProcessor,
        private readonly MessageBusInterface $messageBus,
        #[Autowire(service: 'oneup_flysystem.default_filesystem_filesystem')]
        private readonly FilesystemOperator  $filesystem,
    )
    {
    }

    /**
     * @return User|void
     * @throws FilesystemException
     * @throws ExceptionInterface
     * @var ImportMemberInput $data
     *
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {

        $fileName = $data->file->getClientOriginalName();

        $this->filesystem->write($data->file->getClientOriginalName(),$data->file->getContent(),[]);
        if ($operation instanceof Post ) {
            $this->messageBus->dispatch(new ImportMember($fileName));

//            return $this->removeProcessor->process($data, $operation, $uriVariables, $context);
        }

//        $result = $this->persistProcessor->process($data, $operation, $uriVariables, $context);

    }

}