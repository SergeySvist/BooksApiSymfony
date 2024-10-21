<?php

namespace App\Controller;

use App\Entity\Author;
use App\Model\AuthorDto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{
    #[Route('/api/author', name: 'all_authors', methods: ['GET'], format: 'json')]
    public function index(
        EntityManagerInterface $entityManager
    ): JsonResponse
    {
        $authors = $entityManager->getRepository(Author::class)->findAll();

        return $this->json($authors);
    }

    #[Route('/api/author', name: 'create_author', methods: ['POST'], format: 'json')]
    public function create(
        #[MapRequestPayload] AuthorDto $authorDto,
        EntityManagerInterface $entityManager
    ): JsonResponse
    {
        $author = new Author();

        $author->setFirstname($authorDto->firstName);
        $author->setLastname($authorDto->lastName);
        $author->setFathername($authorDto->fatherName);

        $entityManager->persist($author);
        $entityManager->flush();

        return $this->json($author);
    }
}
