<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\InstrumentRepository")
 */
class Instrument
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"bacteria:read","team:read","instrument:read"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"bacteria:read","team:read","instrument:read"})
     */
    private $sound;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bacteria", mappedBy="instrument")
     */
    private $bacterias;

    public function __construct()
    {
        $this->bacterias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSound(): ?string
    {
        return $this->sound;
    }

    public function setSound(string $sound): self
    {
        $this->sound = $sound;

        return $this;
    }

    /**
     * @return Collection|Bacteria[]
     */
    public function getBacterias(): Collection
    {
        return $this->bacterias;
    }

    public function addBacteria(Bacteria $bacteria): self
    {
        if (!$this->bacterias->contains($bacteria)) {
            $this->bacterias[] = $bacteria;
            $bacteria->setInstrument($this);
        }

        return $this;
    }

    public function removeBacteria(Bacteria $bacteria): self
    {
        if ($this->bacterias->contains($bacteria)) {
            $this->bacterias->removeElement($bacteria);
            // set the owning side to null (unless already changed)
            if ($bacteria->getInstrument() === $this) {
                $bacteria->setInstrument(null);
            }
        }

        return $this;
    }
}
