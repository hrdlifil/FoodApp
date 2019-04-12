<?php

namespace App\Controller;

use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SchrankaZpravController extends AbstractController
{

    private $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * @Route("/login_uspesny/homepage/napsat_zpravu/schranka_zprav/vyhledej_text/{id}", name="vyhledej_text")
     */
    public function index($id)
    {
        $text = $this->messageRepository->find($id)->getText();
        return $this->json(["text" => $text]);
    }
}
