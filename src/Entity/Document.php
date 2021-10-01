<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocumentRepository::class)
 */
class Document
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
    private $Document;

    /**
     * @ORM\Column(type="datetime")
     */
    private $timestamp;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_type;

    /**
     * @ORM\OneToMany(targetEntity=Type::class, mappedBy="document", orphanRemoval=true)
     */
    private $Type;

    public function __construct()
    {
        $this->Type = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDocument(): ?string
    {
        return $this->Document;
    }

    public function setDocument(string $Document): self
    {
        $this->Document = $Document;

        return $this;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getIdType(): ?int
    {
        return $this->id_type;
    }

    public function setIdType(int $id_type): self
    {
        $this->id_type = $id_type;

        return $this;
    }

    /**
     * @return Collection|Type[]
     */
    public function getType(): Collection
    {
        return $this->Type;
    }

    public function addType(Type $type): self
    {
        if (!$this->Type->contains($type)) {
            $this->Type[] = $type;
            $type->setDocument($this);
        }

        return $this;
    }

    public function removeType(Type $type): self
    {
        if ($this->Type->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getDocument() === $this) {
                $type->setDocument(null);
            }
        }

        return $this;
    }
}
