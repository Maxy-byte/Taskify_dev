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

final class TaskController extends AbstractController
{
    #[Route('/', name: 'task_list')]
    public function listTasks(TaskRepository $repo): Response{
        
        $tasks = $repo->findall();
    
        return $this->render('task/index.html.twig', [
            'tasks' => $tasks,
        ]);
    }

    #[Route('/task/{id}/toggle', name: 'task_toggle')]
    public function toggleTask(int $id): Response{
        return new Response('Task toggled');
    }

    #[Route('/task/{id}/edit', name: 'task_edit')]
    public function editTask(int $id, EntityManagerInterface $em): Response{
        $task = $em->getRepository(Task::class)->find($id);

        return $this->redirectToRoute('editor_open',['id' => $task->getId()]);
    }

   #[Route('/goToPage', name: 'task_goToPage', methods: ['GET'])]
   public function goToPage(): Response{
        return $this->redirectToRoute('newPage');
   }

    #[Route('/task/delete/{id}', name: 'task_delete', methods: ['DELETE'])]
    public function deleteTask(int $id, TaskRepository $repo, EntityManagerInterface $em): Response
    {
        $task = $repo->find($id);

        $em->remove($task);
        $em->flush();
    
        return new Response('<meta http-equiv="refresh" content="0;url="' . $this->generateUrl('task_list') . '">');
    }

   #[Route('/task/add', name: 'task_add', methods:['POST'])]
   public function addTask(EntityManagerInterface $em, Request $request): Response{
      $task = new Task();
    
      $title = $request->request->get('taskName');
      $info = $request->request->get('taskInfo');
      $timesheet = $request->request->get('taskTimesheet');

        if ($timesheet){
        $newTimesheet = \DateTime::createFromFormat('Y-m-d', $timesheet);
        $task->setTimesheet($newTimesheet);
      }

      $task->setCreatedAt(new DateTimeImmutable());
      $task->setTitle($title);
      $task->setInfo($info);
          
      $em->persist($task);
      $em->flush();

        return $this->render('task/task.html.twig', [
            'task' => $task,
        ]);
   }

}