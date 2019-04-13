<?php

namespace App\Controller;

use App\Entity\Message;
use App\Repository\OfferRepository;
use App\Repository\ReservationRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class SpravaController extends AbstractController
{
    private $offerRepository;

    private $reservationRepository;

    private $userRepository;

    public function __construct(OfferRepository $offerRepository, ReservationRepository $reservationRepository, UserRepository $userRepository)
    {
        $this->offerRepository = $offerRepository;
        $this->reservationRepository = $reservationRepository;
        $this->userRepository = $userRepository;
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
        $message = new Message();
        // pokud je true pak mažu svoji rezervaci a je potřeba notifikovat uživatele, kterého je nabídka
        if ($rezervace->getUser() === $this->getUser())
        {
            $message->setSender($this->userRepository->findOneBy(["login" => "SYSTEM_ADMIN"]));
            $message->setSubject("Notifikace - Rezervace na vaši nabídku byla zrušena");
            $message->setText("Uživatel " . $this->getUser()->getLogin() . " zrušil svou rezervaci na Vaši nabídku " .
            $nabidka->toString() . " tato nabídka se nyní opět zobrazuje na tržištu");
            $message->setReceiver($nabidka->getUser());
            $message->setTimeOfSending(new \DateTime());
        }
        // mažu rezervaci někoho jiného na svoji nabídku
        else
            {
                $message->setSender($this->userRepository->findOneBy(["login" => "SYSTEM_ADMIN"]));
                $message->setSubject("Notifikace - Vaše rezervace byla zrušena");
                $message->setText("Uživatel " . $this->getUser()->getLogin() . " zrušil Vaši rezervaci na svou nabídku " .
                    $nabidka->toString());
                $message->setReceiver($rezervace->getUser());
                $message->setTimeOfSending(new \DateTime());


            }
        $em = $this->getDoctrine()->getManager();
        $em->persist($nabidka);
        $em->persist($rezervace);
        $em->persist($message);
        $em->flush();
        return $this->redirectToRoute("sprava");
    }
}
