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

final class EditorController extends AbstractController
{
   #[Route('/editor/{id}', name: 'editor_open', methods: ['GET'])]
   public function openEditor(int $id, EntityManagerInterface $em): Response{
    $task = $em->getRepository(Task::class)->find($id);

    return $this->render('editor/index.html.twig', [
        'task' => $task,
    ]);
   }
   #[Route('/editor/{id}/submite', name: 'submite', methods:['POST'])]
   public function submite(EntityManagerInterface $em, Request $request, int $id, TaskRepository $repo): Response{
    $task =$repo->find($id);

    $newTitle = $request->request->get('editTaskName');
    $newTimesheet = $request->request->get('editTaskTimesheet');
    $newInfo = $request->request->get('editTaskInfo');

    $task->setTitle($newTitle);
    $task->setTimesheet($newTimesheet);
    $task->setInfo($newInfo);

    $em->persist($task);
    $em->flush();

      return $this->render('editor/index.html.twig', [
          'task' => $task,
        ]);
   }
}
