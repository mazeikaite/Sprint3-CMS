<?php

declare(strict_types=1);

namespace Models;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="projects", uniqueConstraints={@ORM\UniqueConstraint(columns={"projectName"})})
 */
class Project
{
    // ...
    /**

     * @ORM\Id
     * @ORM\Column(name="projectId", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $projectId;

    /** 
     * @ORM\Column(name="projectName", type="string", length=25, nullable=false) 
     */
    private $projectName;

    /** 
     * One project has many employees. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Employee", mappedBy="project", cascade={"persist", "remove"})
     */
    private $employees;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
    }

    public function setProjectId(int $projectId): self
    {
        $this->projectId = $projectId;

        return $this;
    }

    public function getProjectId(): int
    {
        return $this->projectId;
    }

    public function setProjectName(string $projectName): self
    {
        $this->projectName = $projectName;

        return $this;
    }

    public function getProjectName(): string
    {
        return $this->projectName;
    }

    public function addEmployee(Employee $employees): self
    {
        $this->employees[] = $employees;

        return $this;
    }

    public function removeEmployee(Employee $employee): bool
    {
        return $this->countries->removeElement($employee);
    }

    public function getEmployees(): Collection
    {
        return $this->employees;
    }

    public function __toString()
    {
        return strval($this->getProjectName());
    }
}
