<?php
namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class AuthorDto
{
    public function __construct(
        #[Assert\NotBlank]
        public string $firstName,

        #[Assert\NotBlank]
        #[Assert\Length(
            min: 3,
            max: 255,
            minMessage: 'Your first name must be at least {{ limit }} characters long',
            maxMessage: 'Your first name cannot be longer than {{ limit }} characters',
        )]
        public string $lastName,

        public string $fatherName,
    ) {
    }
}