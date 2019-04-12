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
use App\Repository\MessageRepository;
use App\Repository\OfferRepository;
use App\Repository\ProductRepository;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\AddressType;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
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
     * TODO: zabazpeceni aby nebyl pristup chranen pouze blbym ifem -> HOTOVO
     * @Route("/login_uspesny/homepage/pridat_nabidku", name="pridat_nabidku")
     */
    public function pridatNabidku(BrandRepository $brandRepository, CategoryRepository $categoryRepository)
    {
        if ($this->getUser()->getRole() =="nakupujici" )
        {
            throw new UnauthorizedHttpException("Dobrej pokus, ale nevyšlp :D ");
        }

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
        // vyselektuji z db vsechny nabidky ktere jsou nerezervovane a aktivni
        $nabidky = [];
        $vsechnyNabidky = $offerRepository->findBy(["active" => true, "reserved" => false]);
        $em = $this->getDoctrine()->getManager();
        foreach ($vsechnyNabidky as $nabidka)
        {
            $today = new \DateTime();
            $expiraceNabidky = $nabidka->getOfferExpiration();

            // zjistim jestli neproslo datum expirace nabidky, pokud ano tak jiz neni aktivni
            if ($expiraceNabidky < $today)
            {
                $nabidka->setActive(false);
                $em->persist($nabidka);
            }
            // chci zobrazovat pouze aktivni nerezervovane nabidky
            if ($nabidka->getActive() == true and $nabidka->getReserved() == false)
            {
                $nabidky[] = $nabidka;
            }

        }

        // aktualizuji db tak aby prosle nabidky nebyly aktivni
        $em->flush();
        return $this->render("trziste.html.twig", ["nabidky" => $nabidky]);
    }

    /**
     * @Route("/login_uspesny/homepage/sprava", name="sprava")
     */
    public function sprava(OfferRepository $offerRepository, ReservationRepository $reservationRepository)
    {

        // vyselektuji z db vsechny nabidky, ktere zverejnil user jez jsou aktivni
        $nerezervovaneNabidky = [];
        $rezervovaneNabidky = [];
        $mojeRezervace= $reservationRepository->findBy(["user" => $this->getUser(), "active" => true]);
        $rezervace = [];

        $vsechnyNabidky = $offerRepository->findBy(["active" => true, "user" => $this->getUser()]);
        $em = $this->getDoctrine()->getManager();
        $today = new \DateTime();
        foreach ($vsechnyNabidky as $nabidka)
        {
            $expiraceNabidky = $nabidka->getOfferExpiration();

            // zjistim jestli neproslo datum expirace nabidky, pokud ano tak jiz neni aktivni
            if ($expiraceNabidky < $today)
            {
                $nabidka->setActive(false);
                $em->persist($nabidka);
            }
            // chci zobrazovat pouze aktivni nidky
            if ($nabidka->getActive() == true and $nabidka->getReserved() == false)
            {
                $nerezervovaneNabidky[] = $nabidka;
            }elseif ($nabidka->getActive() == true and $nabidka->getReserved() == true)
            {
                $rezervovaneNabidky[] = $nabidka;

            }
        }


        foreach ($mojeRezervace as $x)
        {
            if ($x->getExpiration() > $today)
            {
                $rezervace[] = $x;
            }else
                {
                    $x->setActive(false);
                    $em->persist($x);
                }
        }

        return $this->render("sprava.html.twig", ["nerezervovaneNabidky" => $nerezervovaneNabidky, "rezervovaneNabidky" => $rezervovaneNabidky, "rezervace" => $rezervace]);
    }

    /**
     * @Route("/login_uspesny/homepage/vyhledat_uzivatele", name="vyhledat_uzivatele")
     */
    public function vyhledavani()
    {
        return $this->render("vyhledat_uzivatele.html.twig");
    }

    /**
     * @Route("/login_uspesny/homepage/napsat_zpravu", name="napsat_zpravu")
     */
    public function zpravy()
    {

        return $this->render("napsat_zpravu.html.twig");
    }

}