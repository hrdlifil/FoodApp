<?php

namespace App\Controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class VyhledavaniController extends AbstractController
{
    private $userRepository;

    private $user;


    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/login_uspesny/homepage/vysledek_vyhledavani/{login}", name="vysledek_vyhledavani")
     */
    public function vyhledejUzivatele($login)
    {

        $this->user = $this->userRepository->findOneBy(['login' => $login]);

        if($this->user == null)
        {
            return $this->json([
                "login" => "x",
                "email" => "non",
                "role" => "non"
            ]);
        }

        return $this->json([
            "login" => $this->user->getLogin(),
            "email" => $this->user->getEmail(),
            "role" => $this->user->getRole()
        ]);
    }

    /**
     * @Route("/login_uspesny/homepage/vyhledat_uzivatele/profil/{login}", name="profil")
     */
    public function prejitNaProfil($login)
    {
        return $this->render("profil.html.twig", ["user" => $this->user]);
    }
}
