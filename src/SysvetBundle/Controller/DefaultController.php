<?php

namespace SysvetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    /**
     * @Route("/")
     */
    public function indexAction() {
        
        return $this->render('default/painel.html.twig');
    }

    /**
     * @Route("/contato", name="contato")
     */
    public function contatoAction(Request $request) {

        $nome = $request->get("nome");

        return $this->render('default/contato.html.twig', array("nome" => $nome));
    }

}
