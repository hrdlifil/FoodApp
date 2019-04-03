<?php
/**
 * Created by PhpStorm.
 * User: filip
 * Date: 21. 3. 2019
 * Time: 2:45
 */



namespace App\Controller;
use App\Entity\Brand;
use App\Entity\Producer;
use App\Entity\Product;
use Doctrine\DBAL\Types\Type;
use App\Entity\Address;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use  App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\UserType;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class IndexController extends Controller
{
    public $user;
    public $registerForm;


    private $twig;
    private $passwordEncoder;

    public function __construct(\Twig_Environment $twiq, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->twig = $twiq;
        $this->passwordEncoder = $passwordEncoder;
        $this->user = new User();

    }



    /**
     * @Route("/", name="dement")
     */
    public function index(Request $request, AuthenticationUtils $authenticationUtils)
    {/*
        Type::addType('user_role', 'App\Helpers\EnumUserRoleType');
        Type::addType('country_of_origin', 'App\Helpers\EnumCountryOfOriginType');
        Type::addType('category_type', 'App\Helpers\EnumCategoryType');

        $em = $this->getDoctrine()->getManager();*/
/*
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
*/

/*
        $producer = new Producer();
        $brand = new Brand();
        $brand->setBrandName("Rich Piana Shit");
        $brand->setProducer($producer);



        $producer->setProducerName("5% nutrition");
        $producer->addBrand($brand);
        $producer->setCountryOfOrigin("USA");

        $product = new Product();
        $product->setProductName("Grow you fcking dick by 15 inches");
        $product->setCategoryType("Uzeniny");
        $product->setBrandId($brand);

        $em->persist($brand);
        $em->persist($producer);
        $em->persist($product);

        $em->flush();*/

        Type::addType('user_role', 'App\Helpers\EnumUserRoleType');
        Type::addType('country_of_origin', 'App\Helpers\EnumCountryOfOriginType');
        Type::addType('category_type', 'App\Helpers\EnumCategoryType');
        Debug::enable();


        $this->registerForm = $this->createForm(UserType::class, $this->user,
            [
                "method" => "POST",
                "action" => "register",

            ]);

        return $this->render("index.html.twig", [
            'form' => $this->registerForm->createView(),
            "lastUsername" => $authenticationUtils->getLastUsername(),
            "error" => $authenticationUtils->getLastAuthenticationError()
        ]);

        //return $this->render("index.html.twig");
    }
}
