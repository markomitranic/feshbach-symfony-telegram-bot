<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LectureRepository")
 * @Vich\Uploadable
 */
class Lecture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Speaker
     * @ORM\ManyToOne(targetEntity="App\Entity\Speaker", inversedBy="lectures")
     */
    private $speaker;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photoUrl;

    /**
     * @Vich\UploadableField(mapping="lecture_images", fileNameProperty="photoUrl")
     * @var File
     */
    private $photoFile;

    /**
     * @var Location
     * @ORM\ManyToOne(targetEntity="App\Entity\Location", inversedBy="lectures")
     */
    private $location;

    /**
     * @var LectureRating[]
     * @ORM\OneToMany(targetEntity="App\Entity\LectureRating", mappedBy="lecture")
     */
    private $ratings;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    public function __construct()
    {
        $this->updatedAt = new \DateTime('now');
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Speaker
     */
    public function getSpeaker(): Speaker
    {
        return $this->speaker;
    }

    /**
     * @param Speaker $speaker
     */
    public function setSpeaker(Speaker $speaker): void
    {
        $this->speaker = $speaker;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): self
    {
        $this->date = $date;

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

    /**
     * @return null|string
     */
    public function getPhotoUrl(): ?string
    {
        return $this->photoUrl;
    }

    /**
     * @param null|string $photoUrl
     */
    public function setPhotoUrl(?string $photoUrl)
    {
        $this->photoUrl = $photoUrl;
    }

    /**
     * @param File|null $image
     */
    public function setPhotoFile(File $image = null)
    {
        $this->photoFile = $image;

        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File|null
     */
    public function getPhotoFile()
    {
        return $this->photoFile;
    }

    /**
     * @return Location
     */
    public function getLocation(): Location
    {
        return $this->location;
    }

    /**
     * @param Location $location
     */
    public function setLocation(Location $location): void
    {
        $this->location = $location;
    }

    /**
     * @return LectureRating[]|null
     */
    public function getRatings()
    {
        return $this->ratings;
    }

    /**
     * @param LectureRating[] $ratings
     */
    public function setRatings(array $ratings): void
    {
        $this->ratings = $ratings;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return null|string
     */
    public function __toString()
    {
        return $this->getSpeaker()->getName();
    }

}
