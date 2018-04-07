<?php

namespace SysvetBundle\Controller;

use SysvetBundle\Entity\Atendimento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Atendimento controller.
 *
 * @Route("atendimento")
 */
class AtendimentoController extends Controller {

    /**
     * Lists all atendimento entities.
     *
     * @Route("/", name="atendimento_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $atendimentos = $em->getRepository('SysvetBundle:Atendimento')->findAll();

        return $this->render('atendimento/index.html.twig', array(
                    'atendimentos' => $atendimentos,
        ));
    }

    /**
     * Creates a new atendimento entity.
     *
     * @Route("/new", name="atendimento_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {


        $atendimento = new Atendimento();
        $atendimento->setData(new \DateTime());
        $atendimento->setUsuario($this->getUser());

        $form = $this->createForm('SysvetBundle\Form\AtendimentoType', $atendimento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $valor = $atendimento->getServico()->getPrecoServico();
            $atendimento->setValor($valor);
            $em = $this->getDoctrine()->getManager();
            $em->persist($atendimento);
            $em->flush();

            return $this->redirectToRoute('atendimento_show', array('id' => $atendimento->getId()));
        }

        return $this->render('atendimento/new.html.twig', array(
                    'atendimento' => $atendimento,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a atendimento entity.
     *
     * @Route("/{id}", name="atendimento_show")
     * @Method("GET")
     */
    public function showAction(Atendimento $atendimento) {

        return $this->render('atendimento/show.html.twig', array(
                    'atendimento' => $atendimento,
        ));
    }

    /**
     * Displays a form to edit an existing atendimento entity.
     *
     * @Route("/{id}/edit", name="atendimento_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Atendimento $atendimento) {

        $editForm = $this->createForm('SysvetBundle\Form\AtendimentoType', $atendimento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('atendimento_edit', array('id' => $atendimento->getId()));
        }

        return $this->render('atendimento/edit.html.twig', array(
                    'atendimento' => $atendimento,
                    'edit_form' => $editForm->createView(),
        ));
    }

}
