<?php
/**
 * Created by PhpStorm.
 * User: filip
 * Date: 21. 3. 2019
 * Time: 19:40
 */

namespace App\Helpers;


class EnumCountryOfOriginType extends EnumType
{
    protected $name = 'country_of_origin';
    protected $values = array('Czech Republic', 'USA', 'Germany', 'Russia', 'Italy', 'TBD');

}