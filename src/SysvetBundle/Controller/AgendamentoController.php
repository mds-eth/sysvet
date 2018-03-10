<?php

namespace SysvetBundle\Controller;

use SysvetBundle\Entity\Agendamento;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Agendamento controller.
 *
 * @Route("agendamento")
 */
class AgendamentoController extends Controller {

    /**
     * Lists all agendamento entities.
     *
     * @Route("/", name="agendamento_index")
     * @Method("GET")
     */
    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $hoje = new \DateTime();

        $query = $em->getRepository('SysvetBundle:Agendamento')
                ->createQueryBuilder('a');

        $agendamentos = $query->where('a.horario >= :hoje')
                ->setParameter('hoje', $hoje)
                ->andWhere('a.status = :status')
                ->setParameter('status', $request->get('status'))
                ->orderBy('a.horario', 'ASC')
                ->getQuery()
                ->getResult();

        return $this->render('agendamento/index.html.twig', array(
                    'agendamentos' => $agendamentos,
        ));
    }

    /**
     * Creates a new agendamento entity.
     *
     * @Route("/new", name="agendamento_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {

        $agendamento = new Agendamento();
        $agendamento->setStatus(Agendamento::STATUS_NOVO);

        $form = $this->createForm('SysvetBundle\Form\AgendamentoType', $agendamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($agendamento);
            $em->flush();

            return $this->redirectToRoute('agendamento_show', array('id' => $agendamento->getId()));
        }

        return $this->render('agendamento/new.html.twig', array(
                    'agendamento' => $agendamento,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a agendamento entity.
     *
     * @Route("/{id}", name="agendamento_show")
     * @Method("GET")
     */
    public function showAction(Agendamento $agendamento) {
        $deleteForm = $this->createDeleteForm($agendamento);

        return $this->render('agendamento/show.html.twig', array(
                    'agendamento' => $agendamento,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing agendamento entity.
     *
     * @Route("/{id}/edit", name="agendamento_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Agendamento $agendamento) {
        $deleteForm = $this->createDeleteForm($agendamento);
        $editForm = $this->createForm('SysvetBundle\Form\AgendamentoType', $agendamento);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('agendamento_edit', array('id' => $agendamento->getId()));
        }

        return $this->render('agendamento/edit.html.twig', array(
                    'agendamento' => $agendamento,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a agendamento entity.
     *
     * @Route("/{id}", name="agendamento_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Agendamento $agendamento) {
        $form = $this->createDeleteForm($agendamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($agendamento);
            $em->flush();
        }

        return $this->redirectToRoute('agendamento_index');
    }

    /**
     * Creates a form to delete a agendamento entity.
     *
     * @param Agendamento $agendamento The agendamento entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Agendamento $agendamento) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('agendamento_delete', array('id' => $agendamento->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
