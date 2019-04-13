<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Reservation;
use App\Repository\OfferRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class TrzisteController extends AbstractController
{
    private $offerRepository;

    private $userRepository;

    public function __construct(OfferRepository $offerRepository, UserRepository $userRepository)
    {
        $this->offerRepository = $offerRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/login_uspesny/homepage/trziste/vice_informaci/{id}", name="vice_informaci")
     * @Method({"POST"})
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
     * @Method({"POST"})
     */
    public function rezervovatNabidku($id)
    {
        $rezervace = new Reservation();
        $nabidka = $this->offerRepository->find($id);
        $rezervace->setOffer($nabidka);
        $rezervace->setUser($this->getUser());
        $rezervace->setBeginning(new \DateTime());
        $rezervace->setExpiration($nabidka->getOfferExpiration());
        $rezervace->setActive(true);
        $nabidka->setReserved(true);
        $nabidka->setReservation($rezervace);
        $message = new Message();
        $message->setReceiver($nabidka->getUser());
        $message->setTimeOfSending(new \DateTime());
        $message->setSubject("Notifikace - Vaše nabídka byla rezervována");
        $message->setText("Uživatel " . $this->getUser()->getLogin() . " si zerazervoval Vaši nabídku " . $nabidka->toString() .
            " rezervace je platná do " . $rezervace->getExpirationString());
        $message->setSender($this->userRepository->findOneBy(["login" => "SYSTEM_ADMIN"]));
        $em = $this->getDoctrine()->getManager();
        $em->persist($rezervace);
        $em->persist($nabidka);
        $em->persist($message);
        $em->flush();

        return $this->redirectToRoute("login_uspesny");
    }
}
