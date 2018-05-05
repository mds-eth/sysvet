<?php

namespace SysvetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use SysvetBundle\Entity\Caixa;

class CaixaController extends Controller {

    /**
     * @Route("/caixa")
     */
    public function indexAction() {

        return $this->render('caixa/index.html.twig');
    }

    /**
     * @Route("/caixa/novo")
     */
    public function novoAction() {
        
    }

    /**
     * @Route("/caixa/add")
     */
    public function addAction(Request $request) {

        $codigo = $request->get('codigo');

        $em = $this->getDoctrine()->getManager();
        $produto = $em->getRepository('SysvetBundle:Produto')->find($codigo);

        return $this->json($produto);
    }

    /**
     * @Route("/caixa/finalizar")
     */
    public function finalizarAction(Request $request) {

        $itens = $request->get('itens');
        $total = $request->get('total');

        $caixa = new Caixa();
        $caixa->setItens($itens);
        $caixa->setTotal($total);
        $caixa->setData(new \DateTime());

        $em = $this->getDoctrine()->getManager();

        $em->persist($caixa);
        $em->flush();

        return $this->json('ok');
    }

}
