<?php

namespace App\Controller;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use DateTimeImmutable;

final class PageController extends AbstractController
{
    #[Route('/new-page', name: 'page_show', methods: ['GET'])]
    public function show(): Response
    {
        return $this->render('page/newTask.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }
}
