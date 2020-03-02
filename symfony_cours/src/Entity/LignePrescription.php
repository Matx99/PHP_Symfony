<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LignePrescriptionRepository")
 */
class LignePrescription
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ordonnance", inversedBy="lignePrescriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $numeroOrrdre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Medicament", inversedBy="lignePrescriptions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $denomination;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $posologie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroOrrdre(): ?Ordonnance
    {
        return $this->numeroOrrdre;
    }

    public function setNumeroOrrdre(?Ordonnance $numeroOrrdre): self
    {
        $this->numeroOrrdre = $numeroOrrdre;

        return $this;
    }

    public function getDenomination(): ?Medicament
    {
        return $this->denomination;
    }

    public function setDenomination(?Medicament $denomination): self
    {
        $this->denomination = $denomination;

        return $this;
    }

    public function getPosologie(): ?string
    {
        return $this->posologie;
    }

    public function setPosologie(string $posologie): self
    {
        $this->posologie = $posologie;

        return $this;
    }
}
