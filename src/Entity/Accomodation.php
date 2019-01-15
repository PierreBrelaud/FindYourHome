<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AccomodationRepository")
 */
class Accomodation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $rooms;

    /**
     * @ORM\Column(type="integer")
     */
    private $bedroom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $floor;

    /**
     * @ORM\Column(type="boolean")
     */
    private $state;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_availability;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $street_number;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="accomodations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\review", mappedBy="accomodation", orphanRemoval=true)
     */
    private $reviews;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\availability", mappedBy="accomodation", orphanRemoval=true)
     */
    private $avalabilities;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\photo", mappedBy="accomodation", orphanRemoval=true)
     */
    private $photos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\bill", mappedBy="accomodation", orphanRemoval=true)
     */
    private $bills;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Location", inversedBy="accomodations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $location;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\book", mappedBy="accomodation", orphanRemoval=true)
     */
    private $books;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="accomodations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
        $this->avalabilities = new ArrayCollection();
        $this->photos = new ArrayCollection();
        $this->bills = new ArrayCollection();
        $this->books = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(int $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getBedroom(): ?int
    {
        return $this->bedroom;
    }

    public function setBedroom(int $bedroom): self
    {
        $this->bedroom = $bedroom;

        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(?int $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getState(): ?bool
    {
        return $this->state;
    }

    public function setState(bool $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getDateAvailability(): ?\DateTimeInterface
    {
        return $this->date_availability;
    }

    public function setDateAvailability(\DateTimeInterface $date_availability): self
    {
        $this->date_availability = $date_availability;

        return $this;
    }

    public function getStreetNumber(): ?string
    {
        return $this->street_number;
    }

    public function setStreetNumber(string $street_number): self
    {
        $this->street_number = $street_number;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|review[]
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews[] = $review;
            $review->setAccomodation($this);
        }

        return $this;
    }

    public function removeReview(review $review): self
    {
        if ($this->reviews->contains($review)) {
            $this->reviews->removeElement($review);
            // set the owning side to null (unless already changed)
            if ($review->getAccomodation() === $this) {
                $review->setAccomodation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|availability[]
     */
    public function getAvalabilities(): Collection
    {
        return $this->avalabilities;
    }

    public function addAvalability(availability $avalability): self
    {
        if (!$this->avalabilities->contains($avalability)) {
            $this->avalabilities[] = $avalability;
            $avalability->setAccomodation($this);
        }

        return $this;
    }

    public function removeAvalability(availability $avalability): self
    {
        if ($this->avalabilities->contains($avalability)) {
            $this->avalabilities->removeElement($avalability);
            // set the owning side to null (unless already changed)
            if ($avalability->getAccomodation() === $this) {
                $avalability->setAccomodation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|photo[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setAccomodation($this);
        }

        return $this;
    }

    public function removePhoto(photo $photo): self
    {
        if ($this->photos->contains($photo)) {
            $this->photos->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getAccomodation() === $this) {
                $photo->setAccomodation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|bill[]
     */
    public function getBills(): Collection
    {
        return $this->bills;
    }

    public function addBill(bill $bill): self
    {
        if (!$this->bills->contains($bill)) {
            $this->bills[] = $bill;
            $bill->setAccomodation($this);
        }

        return $this;
    }

    public function removeBill(bill $bill): self
    {
        if ($this->bills->contains($bill)) {
            $this->bills->removeElement($bill);
            // set the owning side to null (unless already changed)
            if ($bill->getAccomodation() === $this) {
                $bill->setAccomodation(null);
            }
        }

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Collection|book[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->setAccomodation($this);
        }

        return $this;
    }

    public function removeBook(book $book): self
    {
        if ($this->books->contains($book)) {
            $this->books->removeElement($book);
            // set the owning side to null (unless already changed)
            if ($book->getAccomodation() === $this) {
                $book->setAccomodation(null);
            }
        }

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }
}
