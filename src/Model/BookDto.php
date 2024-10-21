<?php
namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class BookDto
{
    public function __construct(
        #[Assert\NotBlank]
        public int $authorId,

        #[Assert\NotBlank]
        public string $title,

        #[Assert\NotBlank]
        public string $shortDescription,

        #[Assert\NotBlank]
        public \DateTime $publishDate,
    ) {
    }
}