<?php

namespace App\Controller;

use App\Repository\OfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrzisteController extends AbstractController
{
    private $offerRepository;

    public function __construct(OfferRepository $offerRepository)
    {
        $this->offerRepository = $offerRepository;
    }

    /**
     * @Route("/login_uspesny/homepage/trziste/vice_informaci/{id}", name="vice_informaci")
     */
    public function viceInformaci($id)
    {
        // uzivatel sem prijde z trziste a jako parametr posle id nabidky, ja si podle id najdu nabidku
        $nabidka = $this->offerRepository->find($id);
        //vratim stranku kde je vice informaci a nabidce na kterou uzivatel klikl
        return $this->render('vice_informaci.html.twig', ["nabidka" => $nabidka]);
    }
}
