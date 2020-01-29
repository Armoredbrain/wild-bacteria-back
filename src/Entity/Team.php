<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Regex("/^\w+/ .")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bacteria", mappedBy="team")
     */
    private $bacterias;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Host", mappedBy="team")
     */
    private $hosts;

    public function __construct()
    {
        $this->bacterias = new ArrayCollection();
        $this->hosts = new ArrayCollection();
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
            $bacteria->setTeam($this);
        }

        return $this;
    }

    public function removeBacteria(Bacteria $bacteria): self
    {
        if ($this->bacterias->contains($bacteria)) {
            $this->bacterias->removeElement($bacteria);
            // set the owning side to null (unless already changed)
            if ($bacteria->getTeam() === $this) {
                $bacteria->setTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Host[]
     */
    public function getHosts(): Collection
    {
        return $this->hosts;
    }

    public function addHost(Host $host): self
    {
        if (!$this->hosts->contains($host)) {
            $this->hosts[] = $host;
            $host->setTeam($this);
        }

        return $this;
    }

    public function removeHost(Host $host): self
    {
        if ($this->hosts->contains($host)) {
            $this->hosts->removeElement($host);
            // set the owning side to null (unless already changed)
            if ($host->getTeam() === $this) {
                $host->setTeam(null);
            }
        }

        return $this;
    }
}
