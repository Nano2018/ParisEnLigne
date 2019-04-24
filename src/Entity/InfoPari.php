<?php

namespace App\Entity;

class InfoPari
{
 
    private $id;

    private $verdict;

    private $montant;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVerdict(): ?string
    {
        return $this->verdict;
    }

    public function setVerdict(string $verdict): self
    {
        $this->verdict = $verdict;

        return $this;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(string $montant): self
    {
        $this->montant = $montant;

        return $this;
    }
}
