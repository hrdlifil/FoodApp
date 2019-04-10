<?php

namespace App\Controller;

use App\Repository\OfferRepository;
use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SpravaController extends AbstractController
{
    private $offerRepository;

    private $reservationRepository;

    public function __construct(OfferRepository $offerRepository, ReservationRepository $reservationRepository)
    {
        $this->offerRepository = $offerRepository;
        $this->reservationRepository = $reservationRepository;
    }

    /**
     * @Route("/login_uspesny/homepage/sprava/smazat_nabidku/{id}", name="smazat_nabidku")
     * @Method({"POST"})
     */
    public function smazatNabidku($id)
    {
        $nabidka = $this->offerRepository->find($id);
        $nabidka->setActive(false);
        $em = $this->getDoctrine()->getManager();
        $em->persist($nabidka);
        $em->flush();
        return $this->redirectToRoute("sprava");
    }

    /**
     * @Route("/login_uspesny/homepage/sprava/zrusit/rezervaci{id_rezervace}", name="zrusit_rezervaci")
     * @Method({"POST"})
     */
    public function zrusitRezervaci($id_rezervace)
    {
        $rezervace = $this->reservationRepository->find($id_rezervace);
        $rezervace->setActive(false);
        $nabidka = $rezervace->getOffer();
        $nabidka->setReserved(false);
        $em = $this->getDoctrine()->getManager();
        $em->persist($nabidka);
        $em->persist($rezervace);
        $em->flush();
        return $this->redirectToRoute("sprava");
    }
}
