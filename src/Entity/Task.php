<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
use DateTimeInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title = null;
    #[ORM\Column(type: 'boolean')]    
    private bool $completed = false;
    #[ORM\Column(type: 'datetime_immutable')]
    private ?DateTimeImmutable $createdAt = null;
    #[ORM\Column(type: 'string')]
    private ?string $info = null;
    #[ORM\Column(type: 'datetime')]
    private ?DateTimeInterface $timesheet = null;
    #[ORM\Column(type: 'integer')]
    private ?int $priority = null;
    
    public function __construct(){
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): ?int{
        return $this->id;
    }

    public function getTitle(): ?string{
        return $this->title;
    }
    public function setTitle(string $title): self{
        $this->title = $title;
        return $this;
    }
    public function isCompleted(): ?bool{
        return $this->completed;
    }
    public function setCompleted(bool $completed): self{
        $this->completed = $completed;
        return $this;
    }
    public function getCreatedAt(): ?DateTimeImmutable{
        return $this->createdAt;
    }
    public function setCreatedAt(DateTimeImmutable $createdAt): self{
        $this->createdAt = $createdAt;
        return $this;
    }
    public function setInfo(string $info): self{
        $this->info = $info;
        return $this;
    }
    public function getInfo(): ?string{
        return $this->info;
    }
    public function setTimesheet(DateTimeInterface $timesheet): self{
        $this->timesheet = $timesheet;
        return $this;
    }
    public function getTimesheet(): DateTimeInterface{
        return $this->timesheet;
    }
    public function setPriority(int $priority): self{
        $this->priority = $priority;
        return $this;
    }
    public function getPriority(): int{
        return $this->priority;
    }
}