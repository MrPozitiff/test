<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class MainPageController
 * @package AppBundle\Controller
 */
class MainPageController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $data = $this->getDoctrine()->getManager()->getRepository('AppBundle:User');

        return $this->render('default/index.html.twig', [
            'users' => $data->loadUserOrderByScore(),
        ]);
    }
}
