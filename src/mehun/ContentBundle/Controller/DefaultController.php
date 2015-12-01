<?php

namespace mehun\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use mehun\ContentBundle\Form\ContactType;
use mehun\ContentBundle\Form\MySurveyType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository('mehunContentBundle:Page')->findAll();
        return $this->render('mehunContentBundle:Default:index.html.twig', array(
            'pages'=>$pages
        ));
    }

    public function displayAction($id) {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('mehunContentBundle:Page')->find($id);

        return $this->render('mehunContentBundle:Default:display.html.twig', array(
           'page'=>$page
        ));
    }

    public function onamaAction()
    {
        return $this->render('mehunContentBundle:Default:onama.html.twig');
    }

    public function reparatureAction()
    {
        return $this->render('mehunContentBundle:Default:reparature.html.twig');
    }

    public function cad_camAction()
    {
        return $this->render('mehunContentBundle:Default:cad_cam.html.twig');
    }

    public function wax_upAction()
    {
        return $this->render('mehunContentBundle:Default:wax_up.html.twig');
    }

    public function smile_designAction()
    {
        return $this->render('mehunContentBundle:Default:smile_design.html.twig');
    }

    public function galerijaAction()
    {
        return $this->render('mehunContentBundle:Default:galerija.html.twig');
    }

    public function partneriAction()
    {
        return $this->render('mehunContentBundle:Default:partneri.html.twig');
    }

    public function cjenikAction()
    {
        return $this->render('mehunContentBundle:Default:cjenik.html.twig');
    }

    public function certifikatiAction()
    {
        return $this->render('mehunContentBundle:Default:certifikati.html.twig');
    }

    public function politika_kvaliteteAction()
    {
        return $this->render('mehunContentBundle:Default:politika_kvalitete.html.twig');
    }

    public function tehnicka_dokumentacijaAction()
    {
        return $this->render('mehunContentBundle:Default:tehnicka_dokumentacija.html.twig');
    }

    public function anketni_upitnikAction(Request $request)
    {
        $form = $this->createForm(new MySurveyType());

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject($form->get('organizacijska_jedinica')->getData())
                    ->setFrom($form->get('email')->getData())
                    ->setTo('ftopolovec2@gmail.com')
                    ->setBody(
                        $this->renderView(
                            'mehunContentBundle:Default:anketa_forma.html.twig',
                            array(
                                'ip' => $request->getClientIp(),
                                'org_jedinica' => $form->get('organizacijska_jedinica')->getData(),
                                'kvaliteta' => $form->get('zadovoljstvo_kvalitetom')->getData(),
                                'cijena_usluga' => $form->get('omjer_cijena-usluga')->getData(),
                                'informiranost' => $form->get('informiranost_o_ponudi_laboratorija')->getData(),
                                'primjedbe_proizvodi' => $form->get('primjedbe_na_proizvode')->getData(),
                                'primjedbe_poslovni_stav' => $form->get('primjedbe_na_poslovni_stav')->getData(),
                                'zakljucak_sugestija' => $form->get('zakljucak_ili_sugestija')->getData()
                            )
                        )
                    );

                $this->get('mailer')->send($message);

                $request->getSession()->getFlashBag()->add('success', 'Uspješno ste poslali anketni upitnik! Hvala Vam!');

                return $this->redirect($this->generateUrl('anketni_upitnik'));
            }
        }

        return $this->render('mehunContentBundle:Default:anketni_upitnik.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function kontaktAction(Request $request)
    {
        $form = $this->createForm(new ContactType());

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject($form->get('predmet')->getData())
                    ->setFrom($form->get('email')->getData())
                    ->setTo('ftopolovec2@gmail.com')
                    ->setBody(
                        $this->renderView(
                            'mehunContentBundle:Default:kontakt_forma.html.twig',
                            array(
                                'ip' => $request->getClientIp(),
                                'ime' => $form->get('ime')->getData(),
                                'poruka' => $form->get('poruka')->getData()
                            )
                        )
                    );

                $this->get('mailer')->send($message);

                $request->getSession()->getFlashBag()->add('success', 'Uspješno ste poslali email! Hvala Vam!');

                return $this->redirect($this->generateUrl('kontakt'));
            }
        }

        return $this->render('mehunContentBundle:Default:kontakt.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
