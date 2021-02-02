<?php

declare(strict_types=1);

namespace Models;

use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity
 * @ORM\Table(name="employees", uniqueConstraints={@ORM\UniqueConstraint(columns={"name"})})
 */
class Employee
{
    // ...
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\Column(name="name", type="string", length=25, nullable=false) 
     */
    private $name;

    /** 
     * Many employees have one project. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Project", inversedBy="employees")//, cascade={"persist"}
     * @ORM\JoinColumn(name="projectId", referencedColumnName="projectId", nullable=true)
     */
    private $project;

    public function __construct()
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setProject(Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getProject(): Project
    {
        return $this->project;
    }
}
