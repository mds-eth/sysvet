<?php

namespace SysvetBundle\Controller;

use SysvetBundle\Entity\Servico;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Servico controller.
 *
 * @Route("servico")
 */
class ServicoController extends Controller {

    /**
     * Lists all servico entities.
     *
     * @Route("/", name="servico_index")
     * @Method("GET")
     */
    public function indexAction(Request $request) {

        $ord = $request->get('ord');

        if ($ord == "") {
            $ord = 'idServico';
        }

        $em = $this->getDoctrine()->getManager();

        $servicos = $em->getRepository('SysvetBundle:Servico')
                ->findBy(array(), array($ord => 'ASC'));

        return $this->render('servico/index.html.twig', array(
                    'servicos' => $servicos,
                    'ord' => $ord
        ));
    }

    /**
     * Creates a new servico entity.
     *
     * @Route("/new", name="servico_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {

        $servico = new Servico();
        $form = $this->createForm('SysvetBundle\Form\ServicoType', $servico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($servico);
            $em->flush();

            return $this->redirectToRoute('servico_show', array('idServico' => $servico->getIdservico()));
        }

        return $this->render('servico/new.html.twig', array(
                    'servico' => $servico,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a servico entity.
     *
     * @Route("/{idServico}", name="servico_show")
     * @Method("GET")
     */
    public function showAction(Servico $servico) {

        $deleteForm = $this->createDeleteForm($servico);

        return $this->render('servico/show.html.twig', array(
                    'servico' => $servico,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing servico entity.
     *
     * @Route("/{idServico}/edit", name="servico_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Servico $servico) {

        $deleteForm = $this->createDeleteForm($servico);
        $editForm = $this->createForm('SysvetBundle\Form\ServicoType', $servico);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('servico_edit', array('idServico' => $servico->getIdservico()));
        }

        return $this->render('servico/edit.html.twig', array(
                    'servico' => $servico,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a servico entity.
     *
     * @Route("/{idServico}", name="servico_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Servico $servico) {

        $form = $this->createDeleteForm($servico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($servico);
            $em->flush();
        }

        return $this->redirectToRoute('servico_index');
    }

    /**
     * Creates a form to delete a servico entity.
     *
     * @param Servico $servico The servico entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Servico $servico) {

        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('servico_delete', array('idServico' => $servico->getIdservico())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
