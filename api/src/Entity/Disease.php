<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DiseaseRepository")
 */
class Disease
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
     * @ORM\ManyToMany(targetEntity="Drug", inversedBy="diseases")
     * @ORM\JoinTable(
     *     name="diseases_drugs",
     *     joinColumns={@ORM\JoinColumn(name="disease_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="drug_id", referencedColumnName="id")}
     * )
     */
    private $drugs;

    public function __construct()
    {
        $this->drugs = new ArrayCollection();
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

    public function getDrugs()
    {
        return $this->drugs;
    }

    public function addDrug(Drug $drug)
    {
        if ($this->drugs->contains($drug)) {
            return;
        }

        $this->drugs->add($drug);
        $drug->addDisease($this);
    }

    public function removeDrug(Drug $drug)
    {
        if (!$this->drugs->contains($drug)) {
            return;
        }

        $this->drugs->removeElement($drug);
        $drug->removeDisease($this);
    }
}
