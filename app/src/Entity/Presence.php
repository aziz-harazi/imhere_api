<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Uid\Uuid;
#[ORM\Entity]
#[ORM\Table(name: 'presence')]
#[ORM\UniqueConstraint(name: 'member_day_uniq)', fields: ['day', 'member'])]
#[ApiResource(normalizationContext: ['groups' => ['presence:read']])]
#[Delete]
#[Get]
#[Patch(denormalizationContext: ['groups' => ['presence.write']])]
#[GetCollection]
#[Post(denormalizationContext: ['groups' => ['presence.write']]),]
class Presence
{

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ApiProperty(identifier: true)]
    #[Groups(['presence:read','member:read'])]
    private Uuid $id;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Groups(['presence:read','presence.write','member:read'])]
    private \DateTimeImmutable $day;

    #[ORM\ManyToOne(targetEntity: Member::class, inversedBy: 'presences')]
    #[ORM\JoinColumn(name: 'member_id', referencedColumnName: 'id')]
    #[Groups(['presence:read','presence.write'])]
    private Member $member;
    public function __construct()
    {
        $this->id = Uuid::v4();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getDay(): \DateTimeImmutable
    {
        return $this->day;
    }

    public function setDay(\DateTimeImmutable $day): self
    {
        $this->day = $day;
        return $this;
    }

    public function getMember(): Member
    {
        return $this->member;
    }

    public function setMember(Member $member): self
    {
        $this->member = $member;
        return $this;
    }


}