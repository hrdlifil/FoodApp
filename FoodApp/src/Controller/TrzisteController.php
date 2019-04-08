<?php

namespace App\Controller;

use App\Entity\Reservation;
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

    /**
     * @Route("/login_uspesny/homepage/trziste/rezervovat_nabidku/{id}", name="rezervovat_nabidku")
     */
    public function rezervovatNabidku($id)
    {
        $rezervace = new Reservation();
        $nabidka = $this->offerRepository->find($id);
        $rezervace->setOffer($nabidka);
        $rezervace->setUser($this->getUser());
        $rezervace->setBeginning(new \DateTime());
        $rezervace->setExpiration($nabidka->getOfferExpiration());
        $nabidka->setReserved(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($rezervace);
        $em->persist($nabidka);
        $em->flush();

        return $this->redirectToRoute("login_uspesny");
    }
}
