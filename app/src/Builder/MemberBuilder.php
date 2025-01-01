<?php

declare(strict_types=1);

namespace App\Builder;

use App\Entity\Member;
use App\Enum\MemberFieldEnum;

class MemberBuilder
{
    private ?string $firstName;
    private ?string $lastName;
    private ?string $gender;
    private ?string $email;
    private ?string $phone;
    private ?string $parentFirstName;
    private ?string $parentLastName;
    private ?string $birthDate;

    public function __construct(array $memberArray)
    {
        $this->firstName = $memberArray[MemberFieldEnum::getFr('firstName')];
        $this->lastName = $memberArray[MemberFieldEnum::getFr('lastName')];
        $this->gender = $memberArray[MemberFieldEnum::getFr('gender')];
        $this->email = $memberArray[MemberFieldEnum::getFr('email')];
        $this->phone = $memberArray[MemberFieldEnum::getFr('phone')];
        $this->parentFirstName = $memberArray[MemberFieldEnum::getFr('parentFirstName')];
        $this->parentLastName = $memberArray[MemberFieldEnum::getFr('parentLastName')];
        $this->birthDate = $memberArray[MemberFieldEnum::getFr('birthdate')];

    }


    public function buildMember(): Member
    {
        return (new Member())
            ->setFirstName($this->firstName)
            ->setLastName($this->lastName)
            ->setGender($this->gender)
            ->setParentEmail($this->email)
            ->setParentPhone($this->phone)
            ->setParentFirstName($this->parentFirstName)
            ->setParentLastName($this->parentLastName)
            ->setBirthDate(new \DateTimeImmutable($this->birthDate));
    }
}