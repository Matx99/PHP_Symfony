<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdonnanceRepository")
 */
class Ordonnance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroOrrdre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Patient", inversedBy="ordonnances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $NumSS;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Medecin", inversedBy="ordonnances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matricule;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateHeure;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\LignePrescription", mappedBy="numeroOrrdre")
     */
    private $lignePrescriptions;

    public function __construct()
    {
        $this->lignePrescriptions = new ArrayCollection();
    }

    public function __toString(){
        return strval($this->numeroOrrdre);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroOrrdre(): ?int
    {
        return $this->numeroOrrdre;
    }

    public function setNumeroOrrdre(int $numeroOrrdre): self
    {
        $this->numeroOrrdre = $numeroOrrdre;

        return $this;
    }

    public function getNumSS(): ?Patient
    {
        return $this->NumSS;
    }

    public function setNumSS(?Patient $NumSS): self
    {
        $this->NumSS = $NumSS;

        return $this;
    }

    public function getMatricule(): ?Medecin
    {
        return $this->matricule;
    }

    public function setMatricule(?Medecin $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getDateHeure(): ?\DateTimeInterface
    {
        return $this->dateHeure;
    }

    public function setDateHeure(?\DateTimeInterface $dateHeure): self
    {
        $this->dateHeure = $dateHeure;

        return $this;
    }

    /**
     * @return Collection|LignePrescription[]
     */
    public function getLignePrescriptions(): Collection
    {
        return $this->lignePrescriptions;
    }

    public function addLignePrescription(LignePrescription $lignePrescription): self
    {
        if (!$this->lignePrescriptions->contains($lignePrescription)) {
            $this->lignePrescriptions[] = $lignePrescription;
            $lignePrescription->setNumeroOrrdre($this);
        }

        return $this;
    }

    public function removeLignePrescription(LignePrescription $lignePrescription): self
    {
        if ($this->lignePrescriptions->contains($lignePrescription)) {
            $this->lignePrescriptions->removeElement($lignePrescription);
            // set the owning side to null (unless already changed)
            if ($lignePrescription->getNumeroOrrdre() === $this) {
                $lignePrescription->setNumeroOrrdre(null);
            }
        }

        return $this;
    }
}
