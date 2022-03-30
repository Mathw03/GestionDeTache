<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $taskName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $taskDescription;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isDone;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="tasks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\OneToOne(targetEntity=GtUser::class, inversedBy="task", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=GtUser::class, mappedBy="taskToDO", cascade={"persist", "remove"})
     */
    private $gtUser;


    /**
     * @ORM\Column(type="dateinterval", nullable=true)
     */
    private $remainTime;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $dateStarted;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaskName(): ?string
    {
        return $this->taskName;
    }

    public function setTaskName(string $taskName): self
    {
        $this->taskName = $taskName;

        return $this;
    }

    public function getTaskDescription(): ?string
    {
        return $this->taskDescription;
    }

    public function setTaskDescription(string $taskDescription): self
    {
        $this->taskDescription = $taskDescription;

        return $this;
    }

    public function getIsDone(): ?bool
    {
        return $this->isDone;
    }

    public function setIsDone(bool $isDone): self
    {
        $this->isDone = $isDone;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getUser(): ?GtUser
    {
        return $this->user;
    }

    public function setUser(?GtUser $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function __toString() {
        return $this->taskName;
    }

    public function getGtUser(): ?GtUser
    {
        return $this->gtUser;
    }

    public function setGtUser(?GtUser $gtUser): self
    {
        // unset the owning side of the relation if necessary
        if ($gtUser === null && $this->gtUser !== null) {
            $this->gtUser->setTaskToDO(null);
        }

        // set the owning side of the relation if necessary
        if ($gtUser !== null && $gtUser->getTaskToDO() !== $this) {
            $gtUser->setTaskToDO($this);
        }

        $this->gtUser = $gtUser;

        return $this;
    }


    public function launchRemainingTime() {

        $dateFin= $this->dateStarted->add($this->remainTime );
        $this->remainTime = date_diff( $dateFin,date("Y-m-d h:i:s"));
    }

    public function getRemainTime(): ?\DateInterval
    {
        return $this->remainTime;
    }

    public function setRemainTime(?\DateInterval $remainTime): self
    {
        $this->remainTime = $remainTime;

        return $this;
    }

    public function getDateStarted(): ?\DateTimeImmutable
    {
        return $this->dateStarted;
    }

    public function setDateStarted(?\DateTimeImmutable $dateStarted): self
    {
        $this->dateStarted = $dateStarted;

        return $this;
    }



}
