<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DrugRepository")
 */
class Drug
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="Disease", mappedBy="drugs")
     */
    private $diseases;

    public function __construct()
    {
        $this->diseases = new ArrayCollection();
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

    public function addDisease(Disease $disease)
    {
        if ($this->diseases->contains($disease)) {
            return;
        }

        $this->diseases->add($disease);
        $disease->addDrug($this);
    }

    public function removeDisease(Disease $disease)
    {
        if (!$this->diseases->contains($disease)) {
            return;
        }

        $this->diseases->removeElement($disease);
        $disease->removeDrug($this);
    }
}
