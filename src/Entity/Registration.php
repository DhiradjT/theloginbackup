<?php

namespace App\Entity;

use App\Repository\RegistrationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegistrationRepository::class)]
class Registration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'registrations')]
    private ?lesson $lesson = null;

    #[ORM\Column(length: 255)]
    private ?string $payment = null;

    #[ORM\ManyToOne(inversedBy: 'registrations')]
    private ?person $person = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLesson(): ?lesson
    {
        return $this->lesson;
    }

    public function setLesson(?lesson $lesson): self
    {
        $this->lesson = $lesson;

        return $this;
    }

    public function getPayment(): ?string
    {
        return $this->payment;
    }

    public function setPayment(string $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    public function getPerson(): ?person
    {
        return $this->person;
    }

    public function setPerson(?person $person): self
    {
        $this->person = $person;

        return $this;
    }
}
