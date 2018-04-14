<?php

namespace SysvetBundle\Controller;

use SysvetBundle\Entity\Produto;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Produto controller.
 *
 * @Route("produto")
 */
class ProdutoController extends Controller {

    /**
     * Lists all produto entities.
     *
     * @Route("/", name="produto_index")
     * @Method("GET")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $produtos = $em->getRepository('SysvetBundle:Produto')->findAll();

        return $this->render('produto/index.html.twig', array(
                    'produtos' => $produtos,
        ));
    }

    /**
     * Creates a new produto entity.
     *
     * @Route("/new", name="produto_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {

        $produto = new Produto();
        $form = $this->createForm('SysvetBundle\Form\ProdutoType', $produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $imagem */
            $imagem = $produto->getImagem();
            $nome_imagem = uniqid() . "." . $imagem->getClientOriginalExtension();

            $imagem->move($this->getParameter("img-produtos"), $nome_imagem);

            $produto->setImagem($nome_imagem);

            $em = $this->getDoctrine()->getManager();
            $em->persist($produto);
            $em->flush();

            return $this->redirectToRoute('produto_show', array('id' => $produto->getId()));
        }

        return $this->render('produto/new.html.twig', array(
                    'produto' => $produto,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a produto entity.
     *
     * @Route("/{id}", name="produto_show")
     * @Method("GET")
     */
    public function showAction(Produto $produto) {
        $deleteForm = $this->createDeleteForm($produto);

        return $this->render('produto/show.html.twig', array(
                    'produto' => $produto,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing produto entity.
     *
     * @Route("/{id}/edit", name="produto_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Produto $produto) {
        $deleteForm = $this->createDeleteForm($produto);
        $editForm = $this->createForm('SysvetBundle\Form\ProdutoType', $produto);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produto_edit', array('id' => $produto->getId()));
        }

        return $this->render('produto/edit.html.twig', array(
                    'produto' => $produto,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a produto entity.
     *
     * @Route("/{id}", name="produto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Produto $produto) {
        $form = $this->createDeleteForm($produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produto);
            $em->flush();
        }

        return $this->redirectToRoute('produto_index');
    }

    /**
     * Creates a form to delete a produto entity.
     *
     * @param Produto $produto The produto entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Produto $produto) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('produto_delete', array('id' => $produto->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
