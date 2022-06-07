<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Voyage
 *
 * @ORM\Table(name="voyage", indexes={@ORM\Index(name="id_vehicule", columns={"id_vehicule"}), @ORM\Index(name="id_planete", columns={"id_planete"})})
 * @ORM\Entity
 */
class Voyage
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_depart", type="date", nullable=false)
     */
    private $dateDepart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_arrive", type="date", nullable=false)
     */
    private $dateArrive;

    /**
     * @var int
     *
     * @ORM\Column(name="nombre_voyageur", type="integer", nullable=false)
     */
    private $nombreVoyageur;

    /**
     * @var int
     *
     * @ORM\Column(name="cout", type="integer", nullable=false)
     */
    private $cout;

    /**
     * @var \Planete
     *
     * @ORM\ManyToOne(targetEntity="Planete")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_planete", referencedColumnName="id")
     * })
     */
    private $idPlanete;

    /**
     * @var \Vehicule
     *
     * @ORM\ManyToOne(targetEntity="Vehicule")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_vehicule", referencedColumnName="id")
     * })
     */
    private $idVehicule;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Client", mappedBy="idVoyage")
     */
    private $idClient;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idClient = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->dateDepart;
    }

    public function setDateDepart(\DateTimeInterface $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getDateArrive(): ?\DateTimeInterface
    {
        return $this->dateArrive;
    }

    public function setDateArrive(\DateTimeInterface $dateArrive): self
    {
        $this->dateArrive = $dateArrive;

        return $this;
    }

    public function getNombreVoyageur(): ?int
    {
        return $this->nombreVoyageur;
    }

    public function setNombreVoyageur(int $nombreVoyageur): self
    {
        $this->nombreVoyageur = $nombreVoyageur;

        return $this;
    }

    public function getCout(): ?int
    {
        return $this->cout;
    }

    public function setCout(int $cout): self
    {
        $this->cout = $cout;

        return $this;
    }

    public function getIdPlanete(): ?Planete
    {
        return $this->idPlanete;
    }

    public function setIdPlanete(?Planete $idPlanete): self
    {
        $this->idPlanete = $idPlanete;

        return $this;
    }

    public function getIdVehicule(): ?Vehicule
    {
        return $this->idVehicule;
    }

    public function setIdVehicule(?Vehicule $idVehicule): self
    {
        $this->idVehicule = $idVehicule;

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getIdClient(): Collection
    {
        return $this->idClient;
    }

    public function addIdClient(Client $idClient): self
    {
        if (!$this->idClient->contains($idClient)) {
            $this->idClient[] = $idClient;
            $idClient->addIdVoyage($this);
        }

        return $this;
    }

    public function removeIdClient(Client $idClient): self
    {
        if ($this->idClient->removeElement($idClient)) {
            $idClient->removeIdVoyage($this);
        }

        return $this;
    }

}
