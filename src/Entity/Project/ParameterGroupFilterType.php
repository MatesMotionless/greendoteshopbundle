<?php

namespace Greendot\EshopBundle\Entity\Project;

use Greendot\EshopBundle\Entity\Project\ParameterGroup;
use Greendot\EshopBundle\Repository\Project\ParameterGroupFilterTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParameterGroupFilterTypeRepository::class)]
class ParameterGroupFilterType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'parameterGroupFilterType', targetEntity: ParameterGroup::class)]
    private Collection $parameterGroup;

    public function __construct()
    {
        $this->parameterGroup = new ArrayCollection();
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

    /**
     * @return Collection<int, ParameterGroup>
     */
    public function getParameterGroup(): Collection
    {
        return $this->parameterGroup;
    }

    public function addParameterGroup(ParameterGroup $parameterGroup): static
    {
        if (!$this->parameterGroup->contains($parameterGroup)) {
            $this->parameterGroup->add($parameterGroup);
            $parameterGroup->setParameterGroupFilterType($this);
        }

        return $this;
    }

    public function removeParameterGroup(ParameterGroup $parameterGroup): static
    {
        if ($this->parameterGroup->removeElement($parameterGroup)) {
            // set the owning side to null (unless already changed)
            if ($parameterGroup->getParameterGroupFilterType() === $this) {
                $parameterGroup->setParameterGroupFilterType(null);
            }
        }

        return $this;
    }
}
