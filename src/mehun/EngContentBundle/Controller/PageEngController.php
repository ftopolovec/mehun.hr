<?php

namespace mehun\EngContentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use mehun\EngContentBundle\Entity\PageEng;
use mehun\EngContentBundle\Form\PageEngType;

/**
 * PageEng controller.
 *
 */
class PageEngController extends Controller
{

    /**
     * Lists all PageEng entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('mehunEngContentBundle:PageEng')->findAll();

        return $this->render('mehunEngContentBundle:PageEng:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new PageEng entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new PageEng();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cms_pageeng_show', array('id' => $entity->getId())));
        }

        return $this->render('mehunEngContentBundle:PageEng:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a PageEng entity.
     *
     * @param PageEng $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PageEng $entity)
    {
        $form = $this->createForm(new PageEngType(), $entity, array(
            'action' => $this->generateUrl('cms_pageeng_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new PageEng entity.
     *
     */
    public function newAction()
    {
        $entity = new PageEng();
        $form   = $this->createCreateForm($entity);

        return $this->render('mehunEngContentBundle:PageEng:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a PageEng entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mehunEngContentBundle:PageEng')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PageEng entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('mehunEngContentBundle:PageEng:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing PageEng entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mehunEngContentBundle:PageEng')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PageEng entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('mehunEngContentBundle:PageEng:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a PageEng entity.
    *
    * @param PageEng $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PageEng $entity)
    {
        $form = $this->createForm(new PageEngType(), $entity, array(
            'action' => $this->generateUrl('cms_pageeng_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing PageEng entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mehunEngContentBundle:PageEng')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PageEng entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cms_pageeng_edit', array('id' => $id)));
        }

        return $this->render('mehunEngContentBundle:PageEng:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a PageEng entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('mehunEngContentBundle:PageEng')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PageEng entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cms_pageeng'));
    }

    /**
     * Creates a form to delete a PageEng entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cms_pageeng_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
