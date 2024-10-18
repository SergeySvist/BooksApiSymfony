<?php

namespace App\Controller;

use App\Model\AuthorDto;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{
    #[Route('/api/author', name: 'all_authors', methods: ['GET'], format: 'json')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller! GET',
            'path' => 'src/Controller/AuthorController.php',
        ]);
    }

    #[Route('/api/author', name: 'create_author', methods: ['POST'], format: 'json')]
    public function createAuthor(
        //#[MapRequestPayload] AuthorDto $authorDto
    ): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller! POST',
            'path' => 'src/Controller/AuthorController.php',
        ]);
    }
}
