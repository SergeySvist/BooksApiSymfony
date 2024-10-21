<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use App\Model\AuthorDto;
use App\Model\BookDto;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    #[Route('/api/book', name: 'all_books', methods: ['GET'], format: 'json')]
    public function index(
        EntityManagerInterface $entityManager
    ): JsonResponse
    {
        $books = $entityManager->getRepository(Book::class)->findAll();
        return $this->json($books);
    }

    #[Route('/api/book/findById/{id}', name: 'find_book_by_id', methods: ['GET'], format: 'json')]
    public function findById(
        Book $book,
    ): JsonResponse
    {
        return $this->json($book);
    }

    #[Route('/api/book/findByAuthorLastname', name: 'find_book_by_author_lastname', methods: ['GET'], format: 'json')]
    public function findByAuthorLastname(
        EntityManagerInterface $entityManager,
        #[MapQueryParameter] string $lastname
    ): JsonResponse
    {
        $books = $entityManager->getRepository(Author::class)->findOneBy(["lastname" => $lastname])->getBooks();
        return $this->json($books);
    }

    #[Route('/api/book', name: 'create_book', methods: ['POST'], format: 'json')]
    public function create(
        #[MapRequestPayload] BookDto $bookDto,
        EntityManagerInterface $entityManager
    ): JsonResponse
    {
        $book = new Book();

        $book->setAuthor($entityManager->getRepository(Author::class)->find($bookDto->authorId));
        $book->setTitle($bookDto->title);
        $book->setShortDescription($bookDto->shortDescription);
        $book->setPublishDate($bookDto->publishDate);

        $entityManager->persist($book);
        $entityManager->flush();

        return $this->json($book);
    }

    #[Route('/api/book/{id}', name: 'update_book', methods: ['PATCH'], format: 'json')]
    public function update(
        Book $book,
        #[MapRequestPayload] BookDto $bookDto,
        EntityManagerInterface $entityManager
    ): JsonResponse
    {
        $book->setAuthor($entityManager->getRepository(Author::class)->find($bookDto->authorId));
        $book->setTitle($bookDto->title);
        $book->setShortDescription($bookDto->shortDescription);
        $book->setPublishDate($bookDto->publishDate);

        $entityManager->flush();

        return $this->json($book);
    }
}
