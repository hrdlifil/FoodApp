<?php

namespace App\Controller;

use App\Entity\Rating;
use App\Repository\RatingRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    private $userRepository;

    private $ratingRepository;

    public function __construct(UserRepository $userRepository, RatingRepository $ratingRepository)
    {
        $this->ratingRepository = $ratingRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/login_uspesny/homepage/vyhledat_uzivatele/profil/vlozit_hodnoceni", name="vlozit_hodnoceni")
     */
    public function index(Request $request)
    {
        $rating = new Rating();

        $hodnoceni = $request->get("hodnoceni");
        // pokud pravda, tak se k nám dostalo neplatné hodnocení, nedělat nic
        if ($hodnoceni < 0 || $hodnoceni > 5)
        {

        }
        // hodnocení je v pořádku
        else
            {
                $komentar = $request->get("komentar");
                $hodnoceny = $this->userRepository->find($request->get("hodnoceny-id"));
                $hodotitel = $this->getUser();
                $rating->setPoints($hodnoceni);
                $rating->setComment($komentar);
                $rating->setSender($hodotitel);
                $rating->setReceiver($hodnoceny);
                $rating->setRatingTime(new \DateTime());
                $em = $this->getDoctrine()->getManager();
                $em->persist($rating);
                $em->flush();
            }

        return $this->redirectToRoute("login_uspesny");

    }

    /**
     * @Route("/login_uspesny/homepage/vyhledat_uzivatele/profil/najit_komentar/{id}", name="najit_komentar")
     */
    public function najitKomentar($id)
    {
        $text = $this->ratingRepository->find($id)->getComment();
        return $this->json(["text" => $text]);

    }
}
