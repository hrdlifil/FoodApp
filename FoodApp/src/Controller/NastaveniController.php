<?php
/**
 * Created by PhpStorm.
 * User: filip
 * Date: 4. 4. 2019
 * Time: 13:16
 */

namespace App\Controller;
use App\Entity\Brand;
use App\Entity\Producer;
use App\Entity\Product;
use App\Form\ZmenitEmail;
use App\Form\ZmenitEmailType;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Type;
use App\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use  App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\AddressType;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Services\CustomError;
use App\Services;


class NastaveniController extends Controller
{
    /**
     * @Route("/login_uspesny/homepage/pridat_adresu_prodavajici", name="pridat_adresu_prodavajici")
     * @Method({"POST"})
     */
    public function pridatAdresuProdavajici(Request $request)
    {
        $adresa = new Address();
        $pridatAdresuForm = $this->createForm(AddressType::class, $adresa);
        $pridatAdresuForm->handleRequest($request);
        if ($pridatAdresuForm->isSubmitted() && $pridatAdresuForm->isValid())
        {
            $user = $this->getUser();
            $user->setRole("prodavajici");
            $user->addAddress($adresa);

            $em = $this->getDoctrine()->getManager();
            $em->persist($adresa);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("login_uspesny");
        }


    }


    /**
     * @Route("/login_uspesny/homepage/chci_se_stat_prodejnou", name="chci_se_stat_prodejnou")
     * @Method({"POST"})
     */
    public function chciSeStatProdejnou(Request $request)
    {
        $adresa = new Address();
        $pridatAdresuForm = $this->createForm(AddressType::class, $adresa);
        $pridatAdresuForm->handleRequest($request);
        if ($pridatAdresuForm->isSubmitted() && $pridatAdresuForm->isValid())
        {
            $user = $this->getUser();
            $user->setRole("prodejna");
            $user->addAddress($adresa);

            $em = $this->getDoctrine()->getManager();
            $em->persist($adresa);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("nastaveni");
        }


    }

    /**
     * @Route("/login_uspesny/homepage/chci_se_stat_organizaci", name="chci_se_stat_organizaci")
     * @Method({"POST"})
     */
    public function chciSeStatOrganizaci(Request $request)
    {
        $adresa = new Address();
        $pridatAdresuForm = $this->createForm(AddressType::class, $adresa);
        $pridatAdresuForm->handleRequest($request);
        if ($pridatAdresuForm->isSubmitted() && $pridatAdresuForm->isValid())
        {
            $user = $this->getUser();
            $user->setRole("organizace");
            $user->addAddress($adresa);

            $em = $this->getDoctrine()->getManager();
            $em->persist($adresa);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("nastaveni");
        }


    }

    /**
     * @Route("/login_uspesny/homepage/nove_username", name="nove_username")
     * @Method({"POST"})
     */
    public function noveUsername(Request $request, UserRepository $userRepository, CustomError $error)
    {
        // vytahnu si z requestu zadany username
        $noveUsername = $request->get("nove-username");
        // zkusim podle nej najit v db usera
        $user = $userRepository->findOneBy(['login' => $noveUsername]);

        // pokud jsem zadneho nenasel, pak zadany username nikdo jeste nepouziva a muze byt zmenen
        if ($user === null)
        {
            $currentUser = $userRepository->find($this->getUser()->getId());
            $currentUser->setLogin($noveUsername);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash("info","Uzivatelske jmeno uspesne zmeneno");
            return $this->redirectToRoute("nastaveni");
        }
        // zadany username nekdo jiz pouziva a proto o tom informuji uzivatele a nic nezmenim
        else
            {
                $this->addFlash("info","Uzivatelske jmeno jiz existuje, zvolte jine");
                return $this->redirectToRoute("nastaveni");
            }

    }

    /**
     * @Route("/login_uspesny/homepage/novy_email", name="novy_email")
     * @Method({"POST"})
     */
    public function zmenitEmail(Request $request, UserRepository $userRepository)
    {
        // vytahnu si z requesty zadany email
        $novyEmail = $request->get("novy-email");
        // zkusim podle nej najit v db usera
        $user = $userRepository->findOneBy(['email' => $novyEmail]);

        // pokud jsem zadneho nenasel, pak zadany mail nikdo jeste nepouziva a muze byt zmenen
        if ($user === null)
        {
            $currentUser = $userRepository->find($this->getUser()->getId());
            $currentUser->setEmail($novyEmail);
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash("info_email","Vas Email byl zmenen");
            return $this->redirectToRoute("nastaveni");
        }
        // zadany mail nekdo jiz pouziva a proto o tom informuji uzivatele a nic nezmenim
        else
        {
            $this->addFlash("info_email","Vami zadany email je jiz pouzivan, zadejte prosim jiny");
            return $this->redirectToRoute("nastaveni");
        }

    }

    /**
     * @Route("/login_uspesny/homepage/nove_heslo", name="nove_heslo")
     * @Method({"POST"})
     */
    public function noveHeslo(Request $request, UserRepository $userRepository, UserPasswordEncoderInterface $passwordEncoder)
    {
        // vytahnu si z requesty zadany email
        $noveHeslo = $request->get("nove-heslo");

        $noveHesloZnovu = $request->get("nove-heslo-znovu");

        if ($noveHeslo !== $noveHesloZnovu)
        {
            $this->addFlash("info_heslo","Zadana hesla se neshoduji");
            return $this->redirectToRoute("nastaveni");
        }else
            {
                $user = $this->getUser();
                $user->setPassword($passwordEncoder->encodePassword($user,$noveHeslo));
                $this->getDoctrine()->getManager()->flush();
                $this->addFlash("info_heslo","Vase heslo bylo zmeneno");
                return $this->redirectToRoute("nastaveni");

            }

    }

    /**
     * @Route("/login_uspesny/homepage/novy_telefon", name="novy_telefon")
     * @Method({"POST"})
     */
    public function novyTelefon(Request $request)
    {
        // vytahnu si z requesty zadany email
        $novyTelefon = $request->get("novy-telefon");

        if (strlen($novyTelefon) < 8)
        {
            $this->addFlash("info_telefon","Zadejte prosim spravny telefon");
            return $this->redirectToRoute("nastaveni");
        }else
            {
                $this->getUser()->setPhone($novyTelefon);
                $this->getDoctrine()->getManager()->flush();
                $this->addFlash("info_telefon","Vas telefon byl zmenen");
                return $this->redirectToRoute("nastaveni");
            }

    }


    /**
     * @Route("/login_uspesny/homepage/nove_jmeno_prodejny", name="nove_jmeno_prodejny")
     * @Method({"POST"})
     */
    public function noveJmenoProdejny(Request $request)
    {
        // vytahnu si z requesty zadany email
        $noveJmenoProdejny = $request->get("nove-jmeno-prodejny");

        if (strlen($noveJmenoProdejny) < 2)
        {
            $this->addFlash("info_prodejna","Zadejte prosim spravne jmeno prodejny");
            return $this->redirectToRoute("nastaveni");
        }else
        {
            $this->getUser()->setNameOfShop($noveJmenoProdejny);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("info_prodejna","Jmeno prodejny bylo zmeneno/pridano");
            return $this->redirectToRoute("nastaveni");
        }

    }


    /**
     * @Route("/login_uspesny/homepage/nove_jmeno_organizace", name="nove_jmeno_organizace")
     * @Method({"POST"})
     */
    public function noveJmenoOrganizace(Request $request)
    {
        // vytahnu si z requesty zadany email
        $noveJmenoOrganizace = $request->get("nove-jmeno-organizace");

        if (strlen($noveJmenoOrganizace) < 2)
        {
            $this->addFlash("info_organizace","Zadejte prosim spravne jmeno organizace");
            return $this->redirectToRoute("nastaveni");
        }else
        {
            $this->getUser()->setNameOfOrganisation($noveJmenoOrganizace);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("info_organizace","Jmeno organizace bylo zmeneno/pridano");
            return $this->redirectToRoute("nastaveni");
        }

    }

}