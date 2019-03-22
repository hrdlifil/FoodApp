<?php
/**
 * Created by PhpStorm.
 * User: filip
 * Date: 21. 3. 2019
 * Time: 2:45
 */



namespace App\Controller;
use Doctrine\DBAL\Types\Type;
use App\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use  App\Entity\User;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        Type::addType('user_role', 'App\Helpers\EnumUserRoleType');

        $em = $this->getDoctrine()->getManager();

        $ad = new Address();
        $ad->setTown("Richov");
        $ad->setStreet("Richova");
        $ad->setHouseNumber(66);
        $ad->setPostCode(66666);

        $em->persist($ad);

        $kokot = new User();
        $kokot->setName("Pavel");
        $kokot->setSurname("Hes");
        $kokot->setLogin("af");
        $kokot->setPassword("af");
        $kokot->setEmail("af.com");
        $kokot->setPhone("666666666");
        $kokot->setRole("prodavajici");
        $kokot->addAddress($ad);

        $em->persist($kokot);
        $em->flush();

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/IndexController.php',
        ]);
    }
}
