<?php

namespace Example\ExampleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ExampleController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction(Request $request)
    {
        return array();
    }
}
