<?php

namespace mehun\EngContentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use mehun\EngContentBundle\Entity\CategoryEng;
use mehun\EngContentBundle\Form\CategoryEngType;

/**
 * CategoryEng controller.
 *
 */
class CategoryEngController extends Controller
{

    /**
     * Lists all CategoryEng entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('mehunEngContentBundle:CategoryEng')->findAll();

        return $this->render('mehunEngContentBundle:CategoryEng:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new CategoryEng entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new CategoryEng();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cms_categoryeng_show', array('id' => $entity->getId())));
        }

        return $this->render('mehunEngContentBundle:CategoryEng:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a CategoryEng entity.
     *
     * @param CategoryEng $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CategoryEng $entity)
    {
        $form = $this->createForm(new CategoryEngType(), $entity, array(
            'action' => $this->generateUrl('cms_categoryeng_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CategoryEng entity.
     *
     */
    public function newAction()
    {
        $entity = new CategoryEng();
        $form   = $this->createCreateForm($entity);

        return $this->render('mehunEngContentBundle:CategoryEng:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CategoryEng entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mehunEngContentBundle:CategoryEng')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CategoryEng entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('mehunEngContentBundle:CategoryEng:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CategoryEng entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mehunEngContentBundle:CategoryEng')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CategoryEng entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('mehunEngContentBundle:CategoryEng:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a CategoryEng entity.
    *
    * @param CategoryEng $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CategoryEng $entity)
    {
        $form = $this->createForm(new CategoryEngType(), $entity, array(
            'action' => $this->generateUrl('cms_categoryeng_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CategoryEng entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mehunEngContentBundle:CategoryEng')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CategoryEng entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cms_categoryeng_edit', array('id' => $id)));
        }

        return $this->render('mehunEngContentBundle:CategoryEng:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a CategoryEng entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('mehunEngContentBundle:CategoryEng')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CategoryEng entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cms_categoryeng'));
    }

    /**
     * Creates a form to delete a CategoryEng entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cms_categoryeng_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
