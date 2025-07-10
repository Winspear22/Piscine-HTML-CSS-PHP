<?php

namespace App\Entity;

use App\Validator as AppAssert;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use App\Enum\EmployeeHours;
use App\Enum\EmployeePosition;
use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[UniqueEntity(fields: ['email'], message: "Cet email est déjà utilisé.")]
#[AppAssert\EmployeeBusiness]
#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le prénom est obligatoire.")]
    #[Assert\Length(max: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le nom est obligatoire.")]
    #[Assert\Length(max: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank(message: "L'email est obligatoire.")]
    #[Assert\Email(message: "Format d'email invalide.")]
    #[Assert\Length(max: 255)]
    private ?string $email = null;

    #[ORM\Column]
    #[Assert\NotNull(message: "La date de naissance est obligatoire.")]
    #[Assert\Type(type: \DateTime::class, message: "Date de naissance invalide.")]
    private ?\DateTime $birthdate = null;

    #[ORM\Column]
    #[Assert\NotNull(message: "L'état actif est obligatoire.")]
    private ?bool $active = null;

    #[ORM\Column]
    #[Assert\NotNull(message: "La date d'embauche est obligatoire.")]
    #[Assert\Type(type: \DateTime::class, message: "Date d'embauche invalide.")]
    private ?\DateTime $employed_since = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Type(type: \DateTime::class, message: "Date de fin de contrat invalide.")]
    private ?\DateTime $employed_until = null;

    #[ORM\Column(enumType: EmployeeHours::class)]
    #[Assert\NotNull(message: "Le nombre d'heures est obligatoire.")]
    private ?EmployeeHours $hours = null;

    #[ORM\Column]
    #[Assert\NotNull(message: "Le salaire est obligatoire.")]
    #[Assert\Positive(message: "Le salaire doit être un entier positif.")]
    private ?int $salary = null;

    #[ORM\Column(enumType: EmployeePosition::class)]
    #[Assert\NotNull(message: "Le poste est obligatoire.")]
    private ?EmployeePosition $position = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'employees')]
    #[ORM\JoinColumn(nullable: true)] // ATTENTION : doit être nullable pour CEO/1er employé
    private ?self $manager = null;

    /** @var Collection<int, self> */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'manager', orphanRemoval: true)]
    private Collection $employees;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
    }

    public function getId(): ?int { return $this->id; }
    public function getFirstname(): ?string { return $this->firstname; }
    public function setFirstname(string $firstname): static { $this->firstname = $firstname; return $this; }
    public function getLastname(): ?string { return $this->lastname; }
    public function setLastname(string $lastname): static { $this->lastname = $lastname; return $this; }
    public function getEmail(): ?string { return $this->email; }
    public function setEmail(string $email): static { $this->email = $email; return $this; }
    public function getBirthdate(): ?\DateTime { return $this->birthdate; }
    public function setBirthdate(\DateTime $birthdate): static { $this->birthdate = $birthdate; return $this; }
    public function isActive(): ?bool { return $this->active; }
    public function setActive(bool $active): static { $this->active = $active; return $this; }
    public function getEmployedSince(): ?\DateTime { return $this->employed_since; }
    public function setEmployedSince(\DateTime $employed_since): static { $this->employed_since = $employed_since; return $this; }
    public function getEmployedUntil(): ?\DateTime { return $this->employed_until; }
    public function setEmployedUntil(?\DateTime $employed_until): static { $this->employed_until = $employed_until; return $this; }
    public function getHours(): ?EmployeeHours { return $this->hours; }
    public function setHours(EmployeeHours $hours): static { $this->hours = $hours; return $this; }
    public function getSalary(): ?int { return $this->salary; }
    public function setSalary(int $salary): static { $this->salary = $salary; return $this; }
    public function getPosition(): ?EmployeePosition { return $this->position; }
    public function setPosition(EmployeePosition $position): static { $this->position = $position; return $this; }
    public function getManager(): ?self { return $this->manager; }
    public function setManager(?self $manager): static { $this->manager = $manager; return $this; }
    /**
     * @return Collection<int, self>
     */
    public function getEmployees(): Collection { return $this->employees; }
    public function addEmployee(self $employee): static {
        if (!$this->employees->contains($employee)) {
            $this->employees->add($employee);
            $employee->setManager($this);
        }
        return $this;
    }
    public function removeEmployee(self $employee): static {
        if ($this->employees->removeElement($employee)) {
            if ($employee->getManager() === $this) {
                $employee->setManager(null);
            }
        }
        return $this;
    }
}
