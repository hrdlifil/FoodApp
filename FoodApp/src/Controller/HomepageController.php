<?php
/**
 * Created by PhpStorm.
 * User: filip
 * Date: 4. 4. 2019
 * Time: 12:12
 */

namespace App\Controller;

use App\Entity\Address;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\AddressType;
use Symfony\Component\Routing\Annotation\Route;


class HomepageController extends Controller
{
    /**
     * @Route("/login_uspesny/homepage/nastaveni", name="nastaveni")
     */
    public function index(Request $request)
    {
        $adresa = new Address();
        $formularPridaniAdresyProdavajici = $this->createForm(AddressType::class, $adresa, [
            "method" => "POST",
            "action" => "pridat_adresu_prodavajici",
        ]);

        return $this->render("nastaveni.html.twig",
            [
                "form_pridat_adresu" => $formularPridaniAdresyProdavajici->createView()
            ]
        );
    }

}