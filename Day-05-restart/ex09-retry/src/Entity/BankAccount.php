<?php

namespace App\Entity;

use App\Repository\BankAccountRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BankAccountRepository::class)]
class BankAccount
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $iban = null;

    #[ORM\Column(length: 255)]
    private ?string $bank_name = null;

    #[ORM\OneToOne(mappedBy: 'BankAccount', cascade: ['persist', 'remove'])]
    private ?Person $person = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIban(): ?int
    {
        return $this->iban;
    }

    public function setIban(int $iban): static
    {
        $this->iban = $iban;

        return $this;
    }

    public function getBankName(): ?string
    {
        return $this->bank_name;
    }

    public function setBankName(string $bank_name): static
    {
        $this->bank_name = $bank_name;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(Person $person): static
    {
        // set the owning side of the relation if necessary
        if ($person->getBankAccount() !== $this) {
            $person->setBankAccount($this);
        }

        $this->person = $person;

        return $this;
    }
}
