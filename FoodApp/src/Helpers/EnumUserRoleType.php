<?php
/**
 * Created by PhpStorm.
 * User: filip
 * Date: 21. 3. 2019
 * Time: 0:57
 */

namespace App\Helpers;

class EnumUserRoleType extends EnumType
{
    protected $name = 'user_role';
    protected $values = array('admin', 'nakupujici', 'prodavajici', 'prodejna', 'organizace');
}