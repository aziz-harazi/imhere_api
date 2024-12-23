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
use League\Flysystem\FilesystemOperator;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Messenger\MessageBusInterface;

class ImportMemberProcessor implements ProcessorInterface
{
    public function __construct(
        #[Autowire(service: 'api_platform.doctrine.orm.state.persist_processor')]
        private ProcessorInterface $persistProcessor,
        #[Autowire(service: 'api_platform.doctrine.orm.state.remove_processor')]
        private ProcessorInterface $removeProcessor,
        private MessageBusInterface $messageBus,
        #[Autowire(service: 'oneup_flysystem.default_filesystem_filesystem')]
        private FilesystemOperator $filesystem,
    )
    {
    }

    /**
     * @var ImportMemberInput $data
     *
     * @return User|void
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
//dump('ici');
//        dump($data);

//        dd($operation instanceof Post );
//        die();

        $this->filesystem->write('test2.png',$data->file->getContent(),[]);
        if ($operation instanceof Post ) {
            dd($operation);
            die();
            $this->messageBus->dispatch(new ImportMember('test.jpg'));

            return $this->removeProcessor->process($data, $operation, $uriVariables, $context);
        }

//        $result = $this->persistProcessor->process($data, $operation, $uriVariables, $context);
//        $this->sendWelcomeEmail($data);

        return ['result' => 'ok'];
    }

}