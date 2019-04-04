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

}