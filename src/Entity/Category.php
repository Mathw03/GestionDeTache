<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
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
    private $categoryName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categoryDescription;

    /**
     * @ORM\OneToMany(targetEntity=Task::class, mappedBy="category")
     */
    private $tasks;

    /**
     * @ORM\OneToMany(targetEntity=GtUser::class, mappedBy="category")
     */
    private $gtUsers;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
        $this->gtUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryName(): ?string
    {
        return $this->categoryName;
    }

    public function setCategoryName(string $categoryName): self
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    public function getCategoryDescription(): ?string
    {
        return $this->categoryDescription;
    }

    public function setCategoryDescription(string $categoryDescription): self
    {
        $this->categoryDescription = $categoryDescription;

        return $this;
    }

    /**
     * @return Collection<int, Task>
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    public function addTask(Task $task): self
    {
        if (!$this->tasks->contains($task)) {
            $this->tasks[] = $task;
            $task->setCategory($this);
        }

        return $this;
    }

    public function removeTask(Task $task): self
    {
        if ($this->tasks->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getCategory() === $this) {
                $task->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, GtUser>
     */
    public function getGtUsers(): Collection
    {
        return $this->gtUsers;
    }

    public function addGtUser(GtUser $gtUser): self
    {
        if (!$this->gtUsers->contains($gtUser)) {
            $this->gtUsers[] = $gtUser;
            $gtUser->setCategory($this);
        }

        return $this;
    }

    public function removeGtUser(GtUser $gtUser): self
    {
        if ($this->gtUsers->removeElement($gtUser)) {
            // set the owning side to null (unless already changed)
            if ($gtUser->getCategory() === $this) {
                $gtUser->setCategory(null);
            }
        }
        return $this;
    }

    public function __toString(){
        return $this->categoryName;
    }

}
