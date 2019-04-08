<?php
/**
 * Created by PhpStorm.
 * User: filip
 * Date: 21. 3. 2019
 * Time: 2:45
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
use App\Form\UserType;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class IndexController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function index(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render("index.html.twig",
            [
                "last_username" => $lastUsername,
                "error" => $error
            ]);
    }

    /**
     * @Route("/login_uspesny/homepage", name="login_uspesny")
     */
    public function loginUspesny()
    {

        return $this->render("homepage.html.twig");
    }

    /**
     *
     *@Route("/security_logout", name="security_logout")
     */
    public function securityLogout(Request $request)
    {

    }
}