<?php
/**
 * Created by PhpStorm.
 * User: filip
 * Date: 22. 3. 2019
 * Time: 18:03
 */

namespace App\Helpers;


class EnumCategoryType extends EnumType
{
    protected $name = 'category_type';
    protected $values = array('Pecivo', 'Jogurty', 'Uzeniny');
}