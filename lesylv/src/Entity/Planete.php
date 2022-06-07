<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Planete
 *
 * @ORM\Table(name="planete", indexes={@ORM\Index(name="id_galaxie", columns={"id_galaxie"})})
 * @ORM\Entity
 */
class Planete
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=250, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="distance", type="string", length=250, nullable=false)
     */
    private $distance;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=250, nullable=false)
     */
    private $type;

    /**
     * @var \Galaxie
     *
     * @ORM\ManyToOne(targetEntity="Galaxie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_galaxie", referencedColumnName="id")
     * })
     */
    private $idGalaxie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDistance(): ?string
    {
        return $this->distance;
    }

    public function setDistance(string $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getIdGalaxie(): ?Galaxie
    {
        return $this->idGalaxie;
    }

    public function setIdGalaxie(?Galaxie $idGalaxie): self
    {
        $this->idGalaxie = $idGalaxie;

        return $this;
    }


}
