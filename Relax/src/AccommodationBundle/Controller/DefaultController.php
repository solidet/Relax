<?php

namespace AccommodationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AccommodationBundle:Default:index.html.twig', array('name' => $name));
    }
}
