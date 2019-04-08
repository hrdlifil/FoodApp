<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Offer;
use App\Entity\PickingOption;
use App\Entity\Price;
use App\Entity\Producer;
use App\Entity\Product;
use App\Form\MakeNewBrandType;
use App\Repository\AddressRepository;
use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;
use App\Repository\PriceRepository;
use App\Repository\ProducerRepository;
use App\Repository\ProductRepository;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PridatNabidkuController extends AbstractController
{
    private $productRepository;

    private $categoryRepository;

    public function __construct(ProductRepository $productRepository, BrandRepository $brandRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->brandRepository = $brandRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @Route("/login_uspesny/homepage/vlozit_nabidku", name="vlozit_nabidku")
     * @Method({"POST"})
     */
    public function pridatNabidku(\Symfony\Component\HttpFoundation\Request $request, AddressRepository $addressRepository, CategoryRepository $categoryRepository, BrandRepository $brandRepository, ProductRepository $productRepository, PriceRepository $repository)
    {
        $nabidka = new Offer();

        //vytahnu si jmeno znacky
        $jmenoZnacky = $request->get("jmeno-znacky");
        //vytahnu si jmeno kategorie
        $jmenoKategorie = $request->get("jmeno-kategorie");
        //vytahnu si jmeno produktu
        $jmenoProduktu = $request->get("jmeno-produktu");
        //vytahnu si puvodni cenu
        $puvodniCena = $request->get("puvodni-cena");
        //vytahnu si soucasnou cenu
        $soucasnaCena = $request->get("soucasna-cena");
        //vytahnu si datum expirace produktu
        $datumExpiraceProduktu = $request->get("datum-expirace-produktu");
        //vytahnu si datum expirace nabidky
        $datumExpiraceNabidky = $request->get("datum-expirace-nabidky");
        // spoctu si slevu
        $sleva = $puvodniCena - $soucasnaCena;
        // vytvorim timestamp kdy bylo vytvoreno
        $inserted = new \DateTime();
        //id adresy vyzvednuti
        $ida = $request->get("misto-vyzvednuti");

        //vytahnu si dodatecne informace
        $dodatecneInformace = $request->get("dodatecne-informace");

        $adresa = $addressRepository->find($ida);

        $pickingOption = new PickingOption();


        $znacka = $brandRepository->findOneBy(["brandName" => $jmenoZnacky]);
        $kategorie = $categoryRepository->findOneBy(["nameOfCategory" => $jmenoKategorie]);
        $produkt = $productRepository->findOneBy(["productName" => $jmenoProduktu]);
        $produkt->setBrand($znacka);
        $produkt->setCategory($kategorie);
        $produkt->setProductName($jmenoProduktu);

        $nabidka->setActive(true);
        $nabidka->setInserted($inserted);
        $nabidka->setProduct($produkt);
        $nabidka->setUser($this->getUser());
        $date = new \DateTime($datumExpiraceNabidky);
        $date2 = new \DateTime($datumExpiraceProduktu);

        $nabidka->setOfferExpiration($date);
        $nabidka->setProductExpiration($date2);
        $pickingOption->setAddress($adresa);
        $pickingOption->setOffer($nabidka);
        $nabidka->setAdditionalInformation($dodatecneInformace);

        $em = $this->getDoctrine()->getManager();
        $em->persist($produkt);
        $em->persist($nabidka);
        $em->persist($pickingOption);
        $em->flush();

        $cena = new Price();
        $cena->setBoughtForPrice($puvodniCena);
        $cena->setCurrentPrice($soucasnaCena);
        $cena->setDiscount($sleva);
        $cena->setOffer($nabidka);
        $em->persist($cena);
        $em->flush();




        //vratim uzivatele zpatky na vytvareni nabidky
        return $this->redirectToRoute("login_uspesny");
    }


    /**
     * @Route("/login_uspesny/homepage/pridat_produkt", name="pridat_produkt")
     */
    public function pridatProdukt(\Symfony\Component\HttpFoundation\Request $request, CategoryRepository $categoryRepository, BrandRepository $brandRepository)
    {
        $produkt = new Product();

        // vytahnu si jmeno produktu
        $jmenoProduktu = $request->get("jmeno-produktu");
        //vytahnu si jmeno kategorie a znacku ktere se odeslali jako hidden a uzivatel je ani nevyplnoval
        $jmenoKategorie = $request->get("jmeno-kategorie");
        $jmenoZnacky = $request->get("jmeno-znacky");
        // najdu si objekty ktere odpovidaji jmenum znacky a kategorie
        $kategorie = $categoryRepository->findOneBy(["nameOfCategory" => $jmenoKategorie]);
        $znacka = $brandRepository->findOneBy(["brandName" => $jmenoZnacky]);
        // nasetuji do produktu vytahnute objekty
        $produkt->setBrand($znacka);
        $produkt->setCategory($kategorie);
        $produkt->setProductName($jmenoProduktu);
        $em = $this->getDoctrine()->getManager();
        $em->persist($produkt);
        $em->flush();

        //vratim uzivatele zpatky na vytvareni nabidky
        return $this->redirectToRoute("pridat_nabidku");
    }

    /**
     * @Route("/login_uspesny/homepage/vytvorit_produkt/{znacka}/{kategorie}", name="vytvorit_produkt")
     */
    public function vytvoritProdukt($znacka, $kategorie)
    {
        return $this->render("vytvorit_novy_produkt.html.twig", ["znacka" => $znacka, "kategorie" => $kategorie]);
    }

    /**
     * @Route("/login_uspesny/homepage/vyhledat_nabidku/{znacka}/{kategorie}", name="vyhledat_nabidku")
     */
    public function index($znacka, $kategorie)
    {
        $znackaObj = $this->brandRepository->findBy(["brandName"=>$znacka]);
        $kategorieObj = $this->categoryRepository->findBy(["nameOfCategory" => $kategorie]);
        $produktyObj = $this->productRepository->getProductByBrandAndCategory($znackaObj,$kategorieObj);

        $produkty = [];
        foreach ($produktyObj as $x)
        {
            $produkty[] = $x->getProductName();
        }

        // hazi circular reference nevim proc
        //$produkty = $this->productRepository->findBy(["category" => $kategorieObj]);
        //$produkty2 = $this->productRepository->getProductByBrandAndCategory($znackaObj,$kategorieObj);
        return $this->json(["produkty" => $produkty]);
    }


    /**
     * @Route("/login_uspesny/homepage/vyhledat_nabidku/pridat_znacku_zobrazit", name="pridat_znacku_zobrazit")
     *
     */
    public function pridatZnackuZobrazit()
    {
        return $this->render("vytvorit_novou_znacku.html.twig");

    }

    /**
     * @Route("/login_uspesny/homepage/vyhledat_nabidku/pridat_kategorii_zobrazit", name="pridat_kategorii_zobrazit")
     *
     */
    public function pridatKategoriiZobrazit()
    {
        return $this->render("vytvorit_novou_kategorii.html.twig");

    }


    /**
     * @Route("/login_uspesny/homepage/vyhledat_nabidku/pridat_kategorii", name="pridat_kategorii")
     * @Method({"POST"})
     */
    public function pridatKategorii(\Symfony\Component\HttpFoundation\Request $request)
    {
        $category = new Category();

        // vytahnu si jmeno ketegorie
        $jmenoKategorie = $request->get("jmeno-kategorie");
        // nasetuji jmeno. ktere zadal uzivatel
        $category->setNameOfCategory($jmenoKategorie);
        // vytvorim entity managera
        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->flush();

        //vratim uzivatele zpatky na vytvareni nabidky
        return $this->redirectToRoute("pridat_nabidku");



    }



    /**
     * @Route("/login_uspesny/homepage/vyhledat_nabidku/pridat_znacku", name="pridat_znacku")
     * @Method({"POST"})
     */
    public function pridatZnacku(\Symfony\Component\HttpFoundation\Request $request, ProducerRepository $producerRepository)
    {
        $znacka = new Brand();

            // vytahnu si jmeno znacku
            $jmenoZnacku = $request->get("jmeno-znacky");
            // vytahnu si jmeno vyrobce
            $jmenoVyrobce = $request->get("jmeno-vyrobce");
            // pokud je jmeno vyrobce mensi nez 1 znamena to, ze ho uzivatel neuvedl a proto automaticky pridelime jmeno
            // jako neznamy
            if (strlen($jmenoVyrobce) < 1)
            {
                $jmenoVyrobce = "neznamy";
            }
            // podivam se, jestli takovy vyrobce uz je v databazi
            $vyrobce = $producerRepository->findOneBy(["producerName" => $jmenoVyrobce]);

            // pokud ne, tak ho vytvorim a jako zemi puvodu dam TBD tedy to be determined s tim
            // ze takto zeme cas od casu projede admin a doplni (naivni, je mi to jasne :D :D )
            if ($vyrobce == null)
            {
                $novyVyrobce = new Producer();
                $novyVyrobce->setCountryOfOrigin("TBD");
                $novyVyrobce->setProducerName($jmenoVyrobce);
                $znacka->setBrandName($jmenoZnacku);
                $znacka->setProducer($novyVyrobce);
                //$novyVyrobce->addBrand($znacka);
                $em = $this->getDoctrine()->getManager();
                $em->persist($novyVyrobce);
                $em->persist($znacka);
                $em->flush();
            }
            // pokud takovy vyrobce existuje tak pouze vytvorim z udaju znacku a pridam mu ji
            else
            {
                $znacka->setBrandName($jmenoZnacku);
                $znacka->setProducer($vyrobce);
                //$vyrobce->addBrand($znacka);
                $em = $this->getDoctrine()->getManager();
                $em->persist($znacka);
                $em->flush();

            }
            return $this->redirectToRoute("pridat_nabidku");



}
}
