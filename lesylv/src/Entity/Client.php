<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity
 */
class Client
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
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=100, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=250, nullable=false)
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="numero", type="integer", nullable=false)
     */
    private $numero;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Voyage", inversedBy="idClient")
     * @ORM\JoinTable(name="reservation",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_client", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_voyage", referencedColumnName="id")
     *   }
     * )
     */
    private $idVoyage;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idVoyage = new \Doctrine\Common\Collections\ArrayCollection();
    }

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * @return Collection|Voyage[]
     */
    public function getIdVoyage(): Collection
    {
        return $this->idVoyage;
    }

    public function addIdVoyage(Voyage $idVoyage): self
    {
        if (!$this->idVoyage->contains($idVoyage)) {
            $this->idVoyage[] = $idVoyage;
        }

        return $this;
    }

    public function removeIdVoyage(Voyage $idVoyage): self
    {
        $this->idVoyage->removeElement($idVoyage);

        return $this;
    }

}
