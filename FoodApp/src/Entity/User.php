<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="application_user")
 * @UniqueEntity(fields="login", message="Toto uzivatelske jmeno je jiz zabrane")
 * @UniqueEntity(fields="email", message="Tento e-mail jiz pouziva nekdo jiny")
 *
 */
class User implements UserInterface, \Serializable
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="user_id")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     */
    private $login;

    /**
     * @ORM\Column(type="string", name="password")
     */
    private $password;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(min=2)
     */
    private $surname;

    /**
     * @ORM\Column(type="string")
     */
    private $phone;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", name="name_of_shop")
     */
    private $nameOfShop;

    /**
     * @ORM\Column(type="string", name="name_of_organisation")
     */
    private $nameOfOrganisation;

    /**
     * user_role je Enum, ktery jsem si sam vytvoril
     * @ORM\Column(type="user_role", name="role")
     *
     */
    private $role;

    /**
     *
     * @ORM\ManyToMany(targetEntity="Address")
     * @ORM\JoinTable(name="address_of_an_user",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="user_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="address_id", referencedColumnName="address_id")}
     *      )
     */
    private $address;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=5)
     */
    private $plainPassword;


    public function getRoles()
    {

        return ["ROLE_USER"];
    }


    public function getPassword()
    {
        return $this->password;
    }


    public function getSalt()
    {
        return null;
    }


    public function getUsername()
    {
        return $this->login;
    }


    public function eraseCredentials()
    {

    }

    public function __construct()
    {
        $this->address = new ArrayCollection();
    }

    public function addAddress(Address $address)
    {
        $this->address[] = $address;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getNameOfShop()
    {
        return $this->nameOfShop;
    }

    /**
     * @param mixed $nameOfShop
     */
    public function setNameOfShop($nameOfShop): void
    {
        $this->nameOfShop = $nameOfShop;
    }

    /**
     * @return mixed
     */
    public function getNameOfOrganisation()
    {
        return $this->nameOfOrganisation;
    }

    /**
     * @param mixed $nameOfOrganisation
     */
    public function setNameOfOrganisation($nameOfOrganisation): void
    {
        $this->nameOfOrganisation = $nameOfOrganisation;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }


    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login): void
    {
        $this->login = $login;
    }


    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role): void
    {
        $this->role = $role;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function serialize()
    {
        return serialize(
            [
                $this->id,
                $this->login,
                $this->password
            ]
        );
    }


    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->login,
            $this->password
            ) = unserialize($serialized);
    }
}
