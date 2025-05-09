<?php

namespace App\Controller;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

final class EditorController extends AbstractController
{
   #[Route('/editor/{id}', name: 'editor_open', methods: ['GET'])]
   public function openEditor(int $id, EntityManagerInterface $em, Request $request): Response{
    $task = $em->getRepository(Task::class)->find($id);

    return $this->render('editor/index.html.twig', [
        'task' => $task,
    ]);
   }
   #[Route('/editor/{id}/submit', name: 'submit', methods:['POST'])]
   public function submit(EntityManagerInterface $em, Request $request, int $id, TaskRepository $repo): Response{
    $task =$repo->find($id);

    $currentTitle = $request->request->get('editTaskName');
    $currentInfo = $request->request->get('editTaskInfo');
    $currentTimesheet = $request->request->get('editTaskTimesheet');
    $currentPriority = $request->request->get('editTaskPriority');

    if ($currentTimesheet) {
        $newTimesheet = \DateTime::createFromFormat('Y-m-d', $currentTimesheet);
        $task->setTimeSheet($newTimesheet);
    }

    $task->setPriority($currentPriority);
    $task->setTitle($currentTitle);
    $task->setInfo($currentInfo);

    $em->persist($task);
    $em->flush();

       return new Response('', 200, ['HX-Redirect' => $this->generateUrl('task_list')]);
   }
}
