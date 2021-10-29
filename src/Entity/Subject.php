<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SubjectRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=SubjectRepository::class)
 * @ApiResource()
 */
class Subject
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tutor_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duration;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->tutor_id;
    }

    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }


    /**
     *
     * @return User
     */
    public function getTutorId(): User
    {
        return $this->tutor_id;
    }

    /**
     * Get User
     *
     * @param User $tutor_id
     * @return self
     */
    public function setTutorId(User $tutor_id): self
    {
        $this->tutor_id = $tutor_id;

        return $this;
    }
}
