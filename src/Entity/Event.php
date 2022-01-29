<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'text', nullable: true)]
    private $description;

    #[ORM\Column(type: 'date')]
    private $sdate;

    #[ORM\Column(type: 'date')]
    private $edate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSdate(): ?\DateTimeInterface
    {
        return $this->sdate;
    }

    public function setSdate(\DateTimeInterface $sdate): self
    {
        $this->sdate = $sdate;

        return $this;
    }

    public function getEdate(): ?\DateTimeInterface
    {
        return $this->edate;
    }

    public function setEdate(\DateTimeInterface $edate): self
    {
        $this->edate = $edate;

        return $this;
    }
}
