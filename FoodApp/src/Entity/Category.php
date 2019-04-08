<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", name="category_id")
     */
    private $categoryId;

    /**
     * @ORM\Column(type="string", name="name_of_category")
     */
    private $nameOfCategory;

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param mixed $categoryId
     */
    public function setCategoryId($categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return mixed
     */
    public function getNameOfCategory()
    {
        return $this->nameOfCategory;
    }

    /**
     * @param mixed $nameOfCategory
     */
    public function setNameOfCategory($nameOfCategory): void
    {
        $this->nameOfCategory = $nameOfCategory;
    }

    public function getId()
    {
        return $this->getCategoryId();
    }

}
