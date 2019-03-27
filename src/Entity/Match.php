<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MatchRepository")
 */
class Match
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sport;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $equipe1;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $equipe2;

    /**
     * @ORM\Column(type="datetime")
     */
    private $quand;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $resultat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pari", mappedBy="matsh")
     */
    private $paris;

    public function __construct()
    {
        $this->paris = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSport(): ?string
    {
        return $this->sport;
    }

    public function setSport(string $sport): self
    {
        $this->sport = $sport;

        return $this;
    }

    public function getEquipe1(): ?string
    {
        return $this->equipe1;
    }

    public function setEquipe1(string $equipe1): self
    {
        $this->equipe1 = $equipe1;

        return $this;
    }

    public function getEquipe2(): ?string
    {
        return $this->equipe2;
    }

    public function setEquipe2(string $equipe2): self
    {
        $this->equipe2 = $equipe2;

        return $this;
    }

    public function getQuand(): ?\DateTimeInterface
    {
        return $this->quand;
    }

    public function setQuand(\DateTimeInterface $quand): self
    {
        $this->quand = $quand;

        return $this;
    }

    public function getResultat(): ?string
    {
        return $this->resultat;
    }

    public function setResultat(string $resultat): self
    {
        $this->resultat = $resultat;

        return $this;
    }

    /**
     * @return Collection|Pari[]
     */
    public function getParis(): Collection
    {
        return $this->paris;
    }

    public function addPari(Pari $pari): self
    {
        if (!$this->paris->contains($pari)) {
            $this->paris[] = $pari;
            $pari->setMatsh($this);
        }

        return $this;
    }

    public function removePari(Pari $pari): self
    {
        if ($this->paris->contains($pari)) {
            $this->paris->removeElement($pari);
            // set the owning side to null (unless already changed)
            if ($pari->getMatsh() === $this) {
                $pari->setMatsh(null);
            }
        }

        return $this;
    }
}
