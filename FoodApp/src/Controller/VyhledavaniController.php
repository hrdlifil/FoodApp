<?php


namespace App\Controller;


use App\Repository\RatingRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
    public function vyhledejUzivatele($login, SessionInterface $session)
    {

        $user = $this->userRepository->findOneBy(['login' => $login]);
        //userId si ulozime do session, v jine route si ho podle toho zase vytahneme z repository
        $session->set("userId", $user->getId());

        if($user == null)
        {
            return $this->json([
                "login" => "x",
                "email" => "non",
                "role" => "non"
            ]);
        }

        return $this->json([
            "login" => $user->getLogin(),
            "email" =>$user->getEmail(),
            "role" => $user->getRole()
        ]);
    }

    /**
     * @Route("/login_uspesny/homepage/vyhledat_uzivatele/profil/{login}", name="profil")
     */
    public function prejitNaProfil($login, UserRepository $userRepository, RatingRepository $ratingRepository)
    {
        //vytahneme si z repository usera podle jeho id, co je v session
        //tady staci jenom potom dat do ifu, jestli v session neco je
        $user = $userRepository->findOneBy(["login" => $login]);

        $ratings = $ratingRepository->getRatingsByReceiver($user->getId());

        $count = 0;
        $sum = 0;

        foreach ($ratings as $rating)
        {
            $count++;
            $sum = $sum + $rating->getPoints();
        }

        if ($count == 0)
        {
            $prumer = "jeste nehodnocen";
        }else
            {
                $prumer = $sum / $count;
            }


        return $this->render("profil.html.twig", ["user" =>$user, "ratings" => $ratings, "hodnoceni" => $prumer]);
    }
}