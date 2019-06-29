<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActivityImagesLinkRepository")
 */
class ActivityImagesLink
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Activity", inversedBy="images")
     */
    private $activity_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image_url;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActivityId(): ?Activity
    {
        return $this->activity_id;
    }

    public function setActivityId(?Activity $activity_id): self
    {
        $this->activity_id = $activity_id;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(?string $image_url): self
    {
        $this->image_url = $image_url;

        return $this;
    }
}
