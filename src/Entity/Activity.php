<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActivityRepository")
 */
class Activity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $popular;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ActivityImagesLink", mappedBy="activity_id")
     */
    private $images;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ActivityCategory")
     * @ORM\JoinTable(name="activity_category_link",
     *     joinColumns={@ORM\JoinColumn(name="activity_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="activity_category_id", referencedColumnName="id")}
     *     )
     */
    private $categories;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPopular(): ?bool
    {
        return $this->popular;
    }

    public function setPopular(bool $popular): self
    {
        $this->popular = $popular;

        return $this;
    }

    /**
     * @return Collection|ActivityImagesLink[]
     */
    public function getImageUrl(): Collection
    {
        return $this->images;
    }

    public function getImageUrlArray(): array
    {
        $imagesArr = [];
        /** @var ActivityImagesLink $image */
        foreach ($this->images as $image) {
            $imagesArr[] = $image->getImageUrl();
        }
        return $imagesArr;
    }

    public function addImageUrl(ActivityImagesLink $imageUrl): self
    {
        if (!$this->images->contains($imageUrl)) {
            $this->images[] = $imageUrl;
            $imageUrl->setActivityId($this);
        }

        return $this;
    }

    public function removeImageUrl(ActivityImagesLink $imageUrl): self
    {
        if ($this->images->contains($imageUrl)) {
            $this->images->removeElement($imageUrl);
            // set the owning side to null (unless already changed)
            if ($imageUrl->getActivityId() === $this) {
                $imageUrl->setActivityId(null);
            }
        }

        return $this;
    }

    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function getCategoriesArr(): array
    {
        $categoriesArr = [];
        /** @var ActivityCategory $category */
        foreach ($this->categories as $category) {
            $categoriesArr[] = $category->getName();
        }
        return $categoriesArr;
    }


    public function addCategory(ActivityCategory $category)
    {
        $this->categories->add($category);
    }

    public function removeCategory(ActivityCategory $category)
    {
        $this->categories->removeElement($category);
    }
}
