<?php

namespace mehun\EngContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use mehun\EngContentBundle\Form\ContactEngType;
use mehun\EngContentBundle\Form\QuestionnaireType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository('mehunEngContentBundle:PageEng')->findAll();
        return $this->render('mehunEngContentBundle:Default:index.html.twig', array(
            'pages' => $pages
        ));
    }

    public function displayAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('mehunEngContentBundle:PageEng')->find($id);

        return $this->render('mehunEngContentBundle:Default:display.html.twig', array(
            'page'=>$page
        ));
    }

    public function aboutAction()
    {
        return $this->render('mehunEngContentBundle:Default:about.html.twig');
    }

    public function repairsAction()
    {
        return $this->render('mehunEngContentBundle:Default:repairs.html.twig');
    }

    public function cad_camAction()
    {
        return $this->render('mehunEngContentBundle:Default:cad_cam.html.twig');
    }

    public function wax_upAction()
    {
        return $this->render('mehunEngContentBundle:Default:wax_up.html.twig');
    }

    public function smile_designAction()
    {
        return $this->render('mehunEngContentBundle:Default:smile_design.html.twig');
    }

    public function galleryAction()
    {
        return $this->render('mehunEngContentBundle:Default:gallery.html.twig');
    }

    public function partnersAction()
    {
        return $this->render('mehunEngContentBundle:Default:partners.html.twig');
    }

    public function pricelistAction()
    {
        return $this->render('mehunEngContentBundle:Default:pricelist.html.twig');
    }

    public function certificatesAction()
    {
        return $this->render('mehunEngContentBundle:Default:certificates.html.twig');
    }

    public function quality_policyAction()
    {
        return $this->render('mehunEngContentBundle:Default:quality_policy.html.twig');
    }

    public function technical_documentationAction()
    {
        return $this->render('mehunEngContentBundle:Default:technical_documentation.html.twig');
    }

    public function questionnaireAction(Request $request)
    {
        $form = $this->createForm(new QuestionnaireType());

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject($form->get('organization_unit')->getData())
                    ->setFrom($form->get('email')->getData())
                    ->setTo('ftopolovec2@gmail.com')
                    ->setBody(
                        $this->renderView(
                            'mehunEngContentBundle:Default:questionnaire_form.html.twig',
                            array(
                                'ip' => $request->getClientIp(),
                                'organization_unit' => $form->get('organization_unit')->getData(),
                                'quality_contentment' => $form->get('quality_contentment')->getData(),
                                'prices_services_ratio' => $form->get('prices_services_ratio')->getData(),
                                'information_and_awareness_about_our_laboratory_offer' => $form->get('information_and_awareness_about_our_laboratory_offer')->getData(),
                                'comments_and_objections_about_products' => $form->get('comments_and_objections_about_products')->getData(),
                                'comments_and_objections_about_business_attitude' => $form->get('comments_and_objections_about_business_attitude')->getData(),
                                'conclusion_and_suggestion' => $form->get('conclusion_and_suggestion')->getData()
                            )
                        )
                    );

                $this->get('mailer')->send($message);

                $request->getSession()->getFlashBag()->add('success', 'Success! Your questionnaire has been submited!');

                return $this->redirect($this->generateUrl('questionnaire'));
            }
        }

        return $this->render('mehunEngContentBundle:Default:questionnaire.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function contactAction(Request $request)
    {
        $form = $this->createForm(new ContactEngType());

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject($form->get('subject')->getData())
                    ->setFrom($form->get('email')->getData())
                    ->setTo('ftopolovec2@gmail.com')
                    ->setBody(
                        $this->renderView(
                            'mehunEngContentBundle:Default:contact_form.html.twig',
                            array(
                                'ip' => $request->getClientIp(),
                                'name' => $form->get('name')->getData(),
                                'message' => $form->get('message')->getData()
                            )
                        )
                    );

                $this->get('mailer')->send($message);

                $request->getSession()->getFlashBag()->add('success', 'Success! Your message has been sent!');

                return $this->redirect($this->generateUrl('contact'));
            }
        }

        return $this->render('mehunEngContentBundle:Default:contact.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
