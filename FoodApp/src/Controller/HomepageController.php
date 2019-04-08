<?php
/**
 * Created by PhpStorm.
 * User: filip
 * Date: 4. 4. 2019
 * Time: 12:12
 */

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Brand;
use App\Entity\User;
use App\Form\MakeNewBrandType;
use App\Form\ZmenitEmail;
use App\Form\ZmenitEmailType;
use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;
use App\Repository\OfferRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\AddressType;
use Symfony\Component\Routing\Annotation\Route;


class HomepageController extends Controller
{
    /**
     * @Route("/login_uspesny/homepage/nastaveni", name="nastaveni")
     */
    public function index()
    {
        $adresa = new Address();
        $adresa2 = new Address();
        $adresa3 = new Address();


        if ($this->getUser()->getRole() === "nakupujici")
        {
            $formularPridaniAdresyProdavajici = $this->createForm(AddressType::class, $adresa, [
                "method" => "POST",
                "action" => "pridat_adresu_prodavajici",
            ]);

            $formularStatSeProdejnou = $this->createForm(AddressType::class, $adresa2, [
                "method" => "POST",
                "action" => "chci_se_stat_prodejnou",
            ]);

            $formularStatSeOrganizaci = $this->createForm(AddressType::class, $adresa3, [
                "method" => "POST",
                "action" => "chci_se_stat_organizaci",
            ]);

            return $this->render("nastaveni_nakupujici.html.twig",
                [
                    "form_pridat_adresu" => $formularPridaniAdresyProdavajici->createView(),
                    "form_stat_se_prodejnou" => $formularStatSeProdejnou->createView(),
                    "form_stat_se_organizaci" => $formularStatSeOrganizaci->createView()
                ]);
        }elseif ($this->getUser()->getRole() === "prodavajici")
        {
            $formularPridaniAdresyProdavajici = $this->createForm(AddressType::class, $adresa, [
                "method" => "POST",
                "action" => "pridat_adresu_prodavajici",
            ]);

            return $this->render("nastaveni_prodavajici.html.twig",[
            "form_pridat_adresu" => $formularPridaniAdresyProdavajici->createView()]);
        }elseif ($this->getUser()->getRole() === "prodejna")
        {
            $formularPridaniAdresyProdavajici = $this->createForm(AddressType::class, $adresa, [
                "method" => "POST",
                "action" => "pridat_adresu_prodavajici",
            ]);

            return $this->render("nastaveni_prodejny.html.twig",[
                "form_pridat_adresu" => $formularPridaniAdresyProdavajici->createView()]);

        }elseif ($this->getUser()->getRole() === "organizace")
        {
            $formularPridaniAdresyProdavajici = $this->createForm(AddressType::class, $adresa, [
                "method" => "POST",
                "action" => "pridat_adresu_prodavajici",
            ]);

            return $this->render("nastaveni_organizace.html.twig",[
                "form_pridat_adresu" => $formularPridaniAdresyProdavajici->createView()]);
        }

    }

    /**
     * TODO: zabazpeceni aby nebyl pristup chranen pouze blbym ifem
     * @Route("/login_uspesny/homepage/pridat_nabidku", name="pridat_nabidku")
     */
    public function pridatNabidku(BrandRepository $brandRepository, CategoryRepository $categoryRepository)
    {
        $znacka = new Brand();

        $poleZnacek = $brandRepository->findAll();
        $poleKategorii = $categoryRepository->findAll();
        if ($this->getUser()->getRole() !== "nakupujici")
        {
            return $this->render("pridat_nabidku.html.twig", [ "pole_znacek" => $poleZnacek, "pole_kategorii" => $poleKategorii]);
        }
    }

    /**
     * @Route("/login_uspesny/homepage/trziste", name="trziste")
     */
    public function trziste(OfferRepository $offerRepository)
    {
        $nabidky = $offerRepository->findAll();
        return $this->render("trziste.html.twig", ["nabidky" => $nabidky]);
    }

}