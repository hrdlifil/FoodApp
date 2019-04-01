<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Brand;
use App\Entity\Producer;
use App\Entity\Product;
use Doctrine\DBAL\Types\Type;
use App\Entity\Address;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class RegisterController extends Controller
{
    /**
     * @Route("/register", name="register")
     */
    public function index(Request $request)
    {
        Type::addType('user_role', 'App\Helpers\EnumUserRoleType');
        Type::addType('country_of_origin', 'App\Helpers\EnumCountryOfOriginType');
        Type::addType('category_type', 'App\Helpers\EnumCategoryType');
        $user = new User();
        $registerForm = $this->createForm(UserType::class, $user);
        $registerForm->handleRequest($request);
        if ($registerForm->isSubmitted() && $registerForm->isValid())
        {
            $user->setRole("prodavajici");
            $user->setPassword("kokot");
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
        }

        return $this->render('register/index.html.twig', [
            'form' => $registerForm->createView()
        ]);
    }
}
