<?php

namespace App\Controller;

use App\Entity\Message;
use App\Repository\MessageRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class NapsatZpravuController extends AbstractController
{
    /**
     * @Route("/login_uspesny/homepage/napsat_zpravu/odeslat_zpravu", name="odeslat_zpravu")
     * @Method("POST")
     */
    public function index(Request $request, UserRepository $userRepository)
    {
        $zprava = new Message();
        $now = new \DateTime();
        $prijemce = $userRepository->findOneBy(["login" => $request->get("jmeno-uzivatele")]);
        $zprava->setSubject($request->get("predmet-zpravy"));
        $zprava->setText($request->get("text-zpravy"));
        $zprava->setSender($this->getUser());
        $zprava->setReceiver($prijemce);
        $zprava->setTimeOfSending($now);
        $em = $this->getDoctrine()->getManager();
        $em->persist($zprava);
        $em->flush();

        return $this->redirectToRoute("login_uspesny");
    }

    /**
     * @Route("/login_uspesny/homepage/napsat_zpravu/schranka_zprav", name="schranka_zprav")
     */
    public function schrankaZprav(MessageRepository $messageRepository)
    {
        $doruceneZpravy = $messageRepository->getMessagesByReciever($this->getUser());
        $odeslaneZpravy = $messageRepository->getMessagesBySender($this->getUser());
        return $this->render("schranka_zprav.html.twig", ["dorucene_zpravy" => $doruceneZpravy, "odeslane_zpravy" => $odeslaneZpravy]);
    }
}
