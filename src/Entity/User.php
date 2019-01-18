<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="Error champ vide"
     * )
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="Error champ vide"
     * )
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="Error champ vide"
     * )
     */
    private $lastname;

    /**
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *     message="Error champ vide"
     * )
     *
     *  @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     * )
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone_fixed;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone_mobile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $about;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isowner;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Review", mappedBy="user", orphanRemoval=true, fetch="EAGER")
     */
    private $reviews;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Book", mappedBy="user", orphanRemoval=true , fetch="EAGER")
     */
    private $books;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Bill", mappedBy="user", orphanRemoval=true , fetch="EAGER")
     */
    private $bills;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Accomodation", mappedBy="user", orphanRemoval=true , fetch="EAGER")
     */
    private $accomodations;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Accomodation", inversedBy="user_favorites" ,fetch="EAGER")
     */
    private $favorites;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(name="password" , type="string", length=255)
     *
     */
    private $password;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
        $this->books = new ArrayCollection();
        $this->bills = new ArrayCollection();
        $this->accomodations = new ArrayCollection();
        $this->favorites = new ArrayCollection();

        //A remplacer
        $this->isowner = false;
    }


    /**
     * @Assert\Callback
     *
     */
    public function validate(ExecutionContextInterface $context)
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPhonefixed(): ?string
    {
        return $this->phone_fixed;
    }

    public function setPhonefixed(?string $phone_fixed): self
    {
        $this->phone_fixed = $phone_fixed;

        return $this;
    }

    public function getPhonemobile(): ?string
    {
        return $this->phone_mobile;
    }

    public function setPhonemobile(?string $phone_mobile): self
    {
        $this->phone_mobile = $phone_mobile;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getAbout(): ?string
    {
        return $this->about;
    }

    public function setAbout(?string $about): self
    {
        $this->about = $about;

        return $this;
    }

    public function getIsowner(): ?bool
    {
        return $this->isowner;
    }

    public function setIsowner(bool $isowner): self
    {
        $this->isowner = $isowner;

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
            $review->setUser($this);
        }

        return $this;
    }

    public function removeReview(review $review): self
    {
        if ($this->reviews->contains($review)) {
            $this->reviews->removeElement($review);
            // set the owning side to null (unless already changed)
            if ($review->getUser() === $this) {
                $review->setUser(null);
            }
        }

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
            $book->setUser($this);
        }

        return $this;
    }

    public function removeBook(book $book): self
    {
        if ($this->books->contains($book)) {
            $this->books->removeElement($book);
            // set the owning side to null (unless already changed)
            if ($book->getUser() === $this) {
                $book->setUser(null);
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
            $bill->setUser($this);
        }

        return $this;
    }

    public function removeBill(bill $bill): self
    {
        if ($this->bills->contains($bill)) {
            $this->bills->removeElement($bill);
            // set the owning side to null (unless already changed)
            if ($bill->getUser() === $this) {
                $bill->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|accomodation[]
     */
    public function getAccomodations(): Collection
    {
        return $this->accomodations;
    }

    public function addAccomodation(accomodation $accomodation): self
    {
        if (!$this->accomodations->contains($accomodation)) {
            $this->accomodations[] = $accomodation;
            $accomodation->setUser($this);
        }

        return $this;
    }

    public function removeAccomodation(accomodation $accomodation): self
    {
        if ($this->accomodations->contains($accomodation)) {
            $this->accomodations->removeElement($accomodation);
            // set the owning side to null (unless already changed)
            if ($accomodation->getUser() === $this) {
                $accomodation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|accomodation[]
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(accomodation $favorite): self
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites[] = $favorite;
        }

        return $this;
    }

    public function removeFavorite(accomodation $favorite): self
    {
        if ($this->favorites->contains($favorite)) {
            $this->favorites->removeElement($favorite);
        }

        return $this;
    }


    /**
     * @see UserInterface
     */
    public function getRoles()
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword()
    {
        return (string) $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }


    //Méthode à implémenter pour UserInterface
    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

}
