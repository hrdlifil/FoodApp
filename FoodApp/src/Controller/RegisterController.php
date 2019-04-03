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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;


class RegisterController extends Controller
{

    private $passwordEncoder;
    private $twig;

    public function __construct(\Twig_Environment $twiq, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->twig = $twiq;
        $this->passwordEncoder = $passwordEncoder;


    }

    /**
     * @Route("/register", name="register")
     */
    public function index(Request $request)
    {

        $user = new User();
        $registerForm = $this->createForm(UserType::class, $user, [
            "method" => "POST",
            "action" => "register",

        ]);
        $registerForm->handleRequest($request);
        if ($registerForm->isSubmitted() && $registerForm->isValid())
        {
            $user->setRole("prodavajici");
            $plainPswd = $user->getPlainPassword();
            $user->setPassword($this->passwordEncoder->encodePassword($user,$plainPswd));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("index");
        }

        return $this->render('registration.html.twig', [
            'form' => $registerForm->createView()
        ]);
    }
}
