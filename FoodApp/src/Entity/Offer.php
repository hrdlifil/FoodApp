<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OfferRepository")
 * @ORM\Table(name="offer")
 */
class Offer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="offer_id")
     */
    private $offerId;

    /**
     * @ORM\Column(type="boolean")
     */
    private $reserved;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="datetime", name="offer_expiration")
     */
    private $offerExpiration;

    /**
     * @ORM\Column(type="datetime", name="product_expiration")
     */
    private $productExpiration;

    /**
     * @ORM\Column(type="datetime")
     */
    private $inserted;

    /**
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinCOlumn(name="product_id", referencedColumnName="product_id")
     */
    private $product;

    /**
     * @ORM\OneToOne(targetEntity="Price")
     * @ORM\JoinColumn(name="price_id", referencedColumnName="price_id")
     */
    private $priceId;

    /**
     * @ORM\OneToMany(targetEntity="PickingOption", mappedBy="picking_option")
     */
    private $pickingOptions;

    public function __construct()
    {
        $this->pickingOptions = new ArrayCollection();
    }

    public function addPickingOption(PickingOption $pickingOption)
    {
        $this->pickingOptions[] = $pickingOption;
    }

    public function getOfferId(): ?int
    {
        return $this->offerId;
    }

    /**
     * @return mixed
     */
    public function getReserved()
    {
        return $this->reserved;
    }

    /**
     * @param mixed $reserved
     */
    public function setReserved($reserved): void
    {
        $this->reserved = $reserved;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active): void
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getOfferExpiration()
    {
        return $this->offerExpiration;
    }

    /**
     * @param mixed $offerExpiration
     */
    public function setOfferExpiration($offerExpiration): void
    {
        $this->offerExpiration = $offerExpiration;
    }

    /**
     * @return mixed
     */
    public function getProductExpiration()
    {
        return $this->productExpiration;
    }

    /**
     * @param mixed $productExpiration
     */
    public function setProductExpiration($productExpiration): void
    {
        $this->productExpiration = $productExpiration;
    }

    /**
     * @return mixed
     */
    public function getInserted()
    {
        return $this->inserted;
    }

    /**
     * @param mixed $inserted
     */
    public function setInserted($inserted): void
    {
        $this->inserted = $inserted;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product): void
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getPriceId()
    {
        return $this->priceId;
    }

    /**
     * @param mixed $priceId
     */
    public function setPriceId($priceId): void
    {
        $this->priceId = $priceId;
    }


}