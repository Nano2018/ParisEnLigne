<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PariRepository")
 */
class Pari
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="paris")
     */
    private $parieur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Match", inversedBy="paris")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matsh;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vainqueur;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="float")
     */
    private $gain;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParieur(): ?User
    {
        return $this->parieur;
    }

    public function setParieur(?User $parieur): self
    {
        $this->parieur = $parieur;

        return $this;
    }

    public function getMatsh(): ?Match
    {
        return $this->matsh;
    }

    public function setMatsh(?Match $matsh): self
    {
        $this->matsh = $matsh;

        return $this;
    }

    public function getVainqueur(): ?string
    {
        return $this->vainqueur;
    }

    public function setVainqueur(string $vainqueur): self
    {
        $this->vainqueur = $vainqueur;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getGain(): ?float
    {
        return $this->gain;
    }

    public function setGain(float $gain): self
    {
        $this->gain = $gain;

        return $this;
    }
}
