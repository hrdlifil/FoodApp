<?php


namespace App\Entity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PriceRepository")
 * @ORM\Table(name="price")
 */
class Price
{
    /**
     * @ORM\OneToOne(targetEntity="Offer")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="offer_id")
     */
    private $offerId;

    /**
     * @ORM\Column(type="string", name="bought_for_price")
     */
    private $boughtForPrice;

    /**
     * @ORM\Column(type="string", name="current_price")
     */
    private $currentPrice;

    /**
     * @ORM\Column(type="string")
     */
    private $discount;



    /**
     * @return mixed
     */
    public function getBoughtForPrice()
    {
        return $this->boughtForPrice;
    }

    /**
     * @param mixed $boughtForPrice
     */
    public function setBoughtForPrice($boughtForPrice): void
    {
        $this->boughtForPrice = $boughtForPrice;
    }

    /**
     * @return mixed
     */
    public function getCurrentPrice()
    {
        return $this->currentPrice;
    }

    /**
     * @param mixed $currentPrice
     */
    public function setCurrentPrice($currentPrice): void
    {
        $this->currentPrice = $currentPrice;
    }

    /**
     * @return mixed
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param mixed $discount
     */
    public function setDiscount($discount): void
    {
        $this->discount = $discount;
    }

}