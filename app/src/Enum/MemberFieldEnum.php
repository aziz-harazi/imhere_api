<?php

declare(strict_types=1);

namespace App\Enum;

enum MemberFieldEnum: string
{

    case FIRSTNAME = 'firstName';
    case LASTNAME = 'lastName';
    case GENDER = 'gender';
    case EMAIL = 'email';
    case PHONE = 'phone';
    case PARENT_FIRSTNAME = 'parentFirstName';
    case PARENT_LASTNAME = 'parentLastName';
    case BIRTHDATE = 'birthdate' ;

    public static function fr(): array
    {

        return [
            self::FIRSTNAME->value => 'Prenom',
            self::LASTNAME->value => 'Nom',
            self::GENDER->value => 'genre',
            self::EMAIL->value => 'email',
            self::PHONE->value => 'tel',
            self::PARENT_FIRSTNAME->value => 'prenom_parent',
            self::PARENT_LASTNAME->value => 'nom_parent',
            self::BIRTHDATE->value => 'date_de_naissance',

        ];
    }

    public static function getFr(string $value): string{
        return self::fr()[$value];
    }
}
