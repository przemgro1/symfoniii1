<?php

// src/AppBundle/Controller/LuckyController.php
namespace AppBundle\Controller;

use AppBundle\Entity\Product;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;


//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

//use Symfony\Component\Serializer\Serializer;
//use Symfony\Component\Serializer\Encoder\XmlEncoder;
//use Symfony\Component\Serializer\Encoder\JsonEncoder;
//use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LuckyController extends Controller
{

    /**
    * @Route("/lucky/number/{n}", name="luck")
    */
    public function numberAction($n)
    {

        $number = mt_rand(10000, 100000);


        $em = $this->get('doctrine')->getManager();

        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(19.99);
        $product->setDescription('Ergonomic and stylish!');

        // tells Doctrine you want to (eventually) save the Product (no queries yet)
//        $em->persist($product);

        // actually executes the queries (i.e. the INSERT query)
//        $em->flush();


        $product = $em->getRepository('AppBundle:Product')
            ->find(11);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id 11'
            );
        }

//        $logger = $this->container->get('logger');
//        $logger->info(print_r($product,1));

//        $encoders = array(new XmlEncoder(), new JsonEncoder());
//        $normalizers = array(new ObjectNormalizer());

//        $serializer = new Serializer($normalizers, $encoders);
//
//

//        $person = new Person();
//        $person->setAge(36);
//        $person->setName('Prz');
//
//        $jsonContent = $serializer->serialize($person, 'json');

// $jsonContent contains {"name":"foo","age":99,"sportsman":false}


//        $jsonContent = 'aaa';

        $jsonContent = 'a';

        $name = 'przemo';



        // Create the Transport
        $transport = (new \Swift_SmtpTransport('wydawnictwo-promedia.pl', 25))
            ->setUsername('hotelarz2@wydawnictwo-promedia.pl')
            ->setPassword('qweRTY321zzAz@')
        ;




// Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);

        $message = new \Swift_Message('Hello Email');

        $imgUrl = $message->embed(\Swift_Image::fromPath('http://oms.westwingpl.pl/themes/store/images/logo2.png'));

        $message
        ->setFrom('hotelarz2@wydawnictwo-promedia.pl')
        ->setTo('itmanager1@westwing.pl')
        ->setBody(
            $this->renderView(
            // app/Resources/views/Emails/registration.html.twig
                'Emails/registration.html.twig',
                array(
                    'name' => $name,
                    'url' => $imgUrl
                )
            ),
            'text/html'
        );

//        $mailer->send($message);

        $doctrine = $this->container->get('doctrine');





        return $this->render('lucky/index.html.twig', array(
            'number' => $number,
            'numbers' => array(
                11,22,33

            )
        ));
//        return new Response($jsonContent);
    }
}

