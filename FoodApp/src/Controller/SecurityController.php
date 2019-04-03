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

class SecurityController
{

    private $twig;

    public function __construct(\Twig_Environment $twiq)
    {
        $this->twig = $twiq;
    }

    /**
     * tato fce je zodpovědná sa validaci přihlašovacího formuláře
     *@Route("/login", name="securityLogin")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        return new Response($this->twig->render("login.html.twig",
            [
                "lastUsername" => $authenticationUtils->getLastUsername(),
                "error" => $authenticationUtils->getLastAuthenticationError()
            ]));
    }

}