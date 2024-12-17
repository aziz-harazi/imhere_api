<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid;
#[ORM\Entity]
#[ORM\Table(name: 'member')]
#[ORM\Index(name: 'gender_idx', fields: ['gender'])]
#[ORM\Index(name: 'first_name_idx', fields: ['firstName'])]
#[ORM\Index(name: 'last_name_idx', fields: ['lastName'])]
class Member
{

    use DateTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: 'uuid', unique: true)]
    private UuidInterface $id;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $firstName;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $lastName;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $gender;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $parentEmail;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $parentPhone;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $parentFirstName;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $parentLastName;

    #[ORM\Column(type: 'datetime_immutable', nullable: false)]
    private \DateTimeImmutable $birthDate;

    #[ORM\ManyToMany(targetEntity: Presence::class, inversedBy: 'members', cascade: ['persist'], fetch: 'EAGER')]
    #[ORM\JoinTable(name: 'member_presence')]
    #[ORM\JoinColumn(name: 'member_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'presence_id', referencedColumnName: 'id')]
    private Collection $presences;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->presences = new ArrayCollection();
    }

    public function getId(): UuidInterface
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