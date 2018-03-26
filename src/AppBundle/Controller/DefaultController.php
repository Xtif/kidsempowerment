<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
  public function indexAction(Request $request)
  {
    return $this->render('default/index.html.twig');
  }

  public function whatWeDoAction(Request $request)
  {
    return $this->render('default/what_we_do.html.twig');
  }

  public function contactUsAction(Request $request)
  {
    return $this->render('default/contact_us.html.twig');
  }

  public function legalNoticesAction(Request $request)
  {
    return $this->render('default/legal_notices.html.twig');
  }

  public function aboutUsAction(Request $request)
  {
    return $this->render('default/about_us.html.twig');
  }
}
