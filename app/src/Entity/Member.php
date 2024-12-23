<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Dto\ImportMemberInput;
use App\State\ImportMemberProcessor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity]
#[ORM\Table(name: 'member')]
#[ORM\Index(name: 'gender_idx', fields: ['gender'])]
#[ORM\Index(name: 'first_name_idx', fields: ['firstName'])]
#[ORM\Index(name: 'last_name_idx', fields: ['lastName'])]
#[ApiResource(
    types: ['https://schema.org/Member'],
    outputFormats: ['jsonld' => ['application/ld+json']],
    normalizationContext: ['groups' => ['member:read']]
)]
#[Delete]
#[Get]
#[Post(
    uriTemplate: '/members/import',
    inputFormats: ['multipart' => ['multipart/form-data']],
    status: Response::HTTP_NO_CONTENT,
    input: ImportMemberInput::class,
    output: false,
    name: 'import',
    processor: ImportMemberProcessor::class

)]
#[Patch(denormalizationContext: ['groups' => ['member:write']])]
#[GetCollection]
#[Post(denormalizationContext: ['groups' => ['member:write']])]
class Member
{

    use DateTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ApiProperty(identifier: true)]
    #[Groups(['member:read','presence:read'])]
    private Uuid $id;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    #[Assert\NotBlank(groups: ['member:write'])]
    #[Groups(['member:read','member:write','presence:read'])]
    #[ApiFilter(SearchFilter::class, strategy: 'partial')]
    private string $firstName;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    #[Assert\NotBlank(groups: ['member:write'])]
    #[Groups(['member:read','member:write','presence:read'])]
    #[ApiFilter(SearchFilter::class, strategy: 'partial')]
    private string $lastName;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    #[Assert\NotBlank(groups: ['member:write'])]
    #[Groups(['member:read','member:write','presence:read'])]
    private string $gender;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    #[Assert\NotBlank(groups: ['member:write'])]
    #[Groups(['member:read','member:write'])]
    private string $parentEmail;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    #[Assert\NotBlank(groups: ['member:write'])]
    #[Groups(['member:read','member:write'])]
    private string $parentPhone;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    #[Assert\NotBlank(groups: ['member:write'])]
    #[Groups(['member:read','member:write'])]
    private string $parentFirstName;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    #[Assert\NotBlank(groups: ['member:write'])]
    #[Groups(['member:read','member:write'])]
    private string $parentLastName;

    #[ORM\Column(type: 'datetime_immutable', nullable: false)]
    #[Assert\NotBlank(groups: ['member:write'])]
    #[Groups(['member:read','member:write'])]
    private \DateTimeImmutable $birthDate;

    #[ORM\OneToMany(targetEntity: Presence::class, mappedBy: 'member')]
    #[Groups(['member:read'])]
    private Collection $presences;


    public function __construct()
    {
        $this->id = Uuid::v4();
        $this->presences = new ArrayCollection();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }
    public function getPresences(): Collection
    {
        return $this->presences;
    }

    public function setPresences(Collection $presences): self
    {
        $this->presences = $presences;
        return $this;
    }

    public function getBirthDate(): \DateTimeImmutable
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeImmutable $birthDate): self
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    public function getParentLastName(): string
    {
        return $this->parentLastName;
    }

    public function setParentLastName(string $parentLastName): self
    {
        $this->parentLastName = $parentLastName;
        return $this;
    }

    public function getParentFirstName(): string
    {
        return $this->parentFirstName;
    }

    public function setParentFirstName(string $parentFirstName): self
    {
        $this->parentFirstName = $parentFirstName;
        return $this;
    }

    public function getParentPhone(): string
    {
        return $this->parentPhone;
    }

    public function setParentPhone(string $parentPhone): self
    {
        $this->parentPhone = $parentPhone;
        return $this;
    }

    public function getParentEmail(): string
    {
        return $this->parentEmail;
    }

    public function setParentEmail(string $parentEmail): self
    {
        $this->parentEmail = $parentEmail;
        return $this;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }





}