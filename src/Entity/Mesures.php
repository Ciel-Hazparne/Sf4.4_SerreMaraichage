<?php

namespace App\Entity;

use App\Repository\MesuresRepository2;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MesuresRepository2::class)
 * @ApiResource(
 *     collectionOperations={"GET", "POST"}
 *     )
 */
class Mesures
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $valeur;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string")
     */
    private $maintenance;

    /**
     * @ORM\ManyToOne(targetEntity=LibelleMesures::class, inversedBy="mesures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $libelleMesures;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValeur(): ?float
    {
        return $this->valeur;
    }

    public function setValeur(float $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getMaintenance(): ?string
    {
        return $this->maintenance;
    }

    public function setMaintenance(string $maintenance): self
    {
        $this->maintenance = $maintenance;

        return $this;
    }

    public function __construct(){
    $this->createdAt= new \DateTime();
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getLibelleMesures(): ?LibelleMesures
    {
        return $this->libelleMesures;
    }

    public function setLibelleMesures(?LibelleMesures $libelleMesures): self
    {
        $this->libelleMesures = $libelleMesures;

        return $this;
    }
}
