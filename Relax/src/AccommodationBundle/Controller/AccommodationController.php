<?php

namespace AccommodationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AccommodationBundle\Entity\Accommodation;
use AccommodationBundle\Form\AccommodationType;

/**
 * Accommodation controller.
 *
 * @Route("/accommodation")
 */
class AccommodationController extends Controller
{

    /**
     * Lists all Accommodation entities.
     *
     * @Route("/", name="accommodation")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AccommodationBundle:Accommodation')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Accommodation entity.
     *
     * @Route("/", name="accommodation_create")
     * @Method("POST")
     * @Template("AccommodationBundle:Accommodation:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Accommodation();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('accommodation_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Accommodation entity.
     *
     * @param Accommodation $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Accommodation $entity)
    {
        $form = $this->createForm(new AccommodationType(), $entity, array(
            'action' => $this->generateUrl('accommodation_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Accommodation entity.
     *
     * @Route("/new", name="accommodation_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Accommodation();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Accommodation entity.
     *
     * @Route("/{id}", name="accommodation_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AccommodationBundle:Accommodation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Accommodation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Accommodation entity.
     *
     * @Route("/{id}/edit", name="accommodation_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AccommodationBundle:Accommodation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Accommodation entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Accommodation entity.
    *
    * @param Accommodation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Accommodation $entity)
    {
        $form = $this->createForm(new AccommodationType(), $entity, array(
            'action' => $this->generateUrl('accommodation_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Accommodation entity.
     *
     * @Route("/{id}", name="accommodation_update")
     * @Method("PUT")
     * @Template("AccommodationBundle:Accommodation:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AccommodationBundle:Accommodation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Accommodation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('accommodation_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Accommodation entity.
     *
     * @Route("/{id}", name="accommodation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AccommodationBundle:Accommodation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Accommodation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('accommodation'));
    }

    /**
     * Creates a form to delete a Accommodation entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('accommodation_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
