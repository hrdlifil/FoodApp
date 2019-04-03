<?php
/**
 * Created by PhpStorm.
 * User: filip
 * Date: 3. 4. 2019
 * Time: 0:55
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\DBAL\Types\Type;

class SecurityController extends Controller
{


    /**
     * tato fce je zodpovědná sa validaci přihlašovacího formuláře
     *@Route("/login", name="security_login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername  = $authenticationUtils->getLastUsername();
        return $this->render("registration.html.twig",
            [
                "last_username" => $lastUsername,
                "error" => $error
            ]);
    }

    /**
 * tato fce je zodpovědná sa validaci přihlašovacího formuláře
 *@Route("/login_uspesny", name="login_uspesny")
 */
    public function loginProbehlUspesne(Request $request, AuthenticationUtils $authenticationUtils)
    {


        return $this->render("base.html.twig");
    }

    /**
     * tato fce je zodpovědná sa validaci přihlašovacího formuláře
     *@Route("/security_logout", name="security_logout")
     */
    public function securityLogout(Request $request, AuthenticationUtils $authenticationUtils)
    {


        return $this->render("base.html.twig");
    }

}