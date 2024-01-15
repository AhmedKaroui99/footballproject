<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File; // Add this line for the File class
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]
#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    // #[ORM\Column(length: 255)]
    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $logo = null;

    
    // #[Vich\UploadableField(mapping: 'teams_images', fileNameProperty: 'logo')]
    #[Vich\UploadableField(mapping: 'teams_images', fileNameProperty: 'logo')]
    private ?File $logoFile = null;
  

    #[ORM\OneToMany(mappedBy: 'team', targetEntity: Coach::class)]
    private Collection $coaches;

   
   


    public function __construct()
    {
        $this->coaches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }
    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): void
    {
        $this->logo = $logo;
    }
    public function getLogoFile(): ?File
    {
        return $this->logoFile;
    }
    public function setLogoFile( ?File $logoFile = null): void
    {
        $this->logoFile = $logoFile;

    }



    /**
     * @return Collection<int, Coach>
     */
    public function getCoaches(): Collection
    {
        return $this->coaches;
    }

    public function addCoach(Coach $coach): static
    {
        if (!$this->coaches->contains($coach)) {
            $this->coaches->add($coach);
            $coach->setTeam($this);
        }

        return $this;
    }

    public function removeCoach(Coach $coach): static
    {
        if ($this->coaches->removeElement($coach)) {
            // set the owning side to null (unless already changed)
            if ($coach->getTeam() === $this) {
                $coach->setTeam(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this->name;
    }
}