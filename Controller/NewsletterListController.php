<?php

namespace tsCMS\NewsletterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\HttpFoundation\Request;
use tsCMS\NewsletterBundle\Entity\NewsletterList;
use tsCMS\NewsletterBundle\Services\NewsletterService;
use tsCMS\NewsletterBundle\Form\NewsletterListType;

/**
 * @Route("/newsletterList")
 */
class NewsletterListController extends Controller
{
    /**
     * @Route("")
     * @Template()
     */
    public function indexAction()
    {
        /** @var NewsletterService $newsletterService */
        $newsletterService = $this->get("tsCMS_newsletter.newsletterservice");

        return array(
            "newsletterlists" => $newsletterService->getNewsletterLists()
        );
    }

    /**
     * @Route("/create")
     * @Secure("ROLE_ADMIN")
     * @Template("tsCMSNewsletterBundle:NewsletterList:newsletterlist.html.twig")
     */
    public function createAction(Request $request)
    {
        $newsletterList = new NewsletterList();
        $form = $this->createForm(new NewsletterListType(), $newsletterList);
        $form->handleRequest($request);
        if ($form->isValid()) {

            $this->getDoctrine()->getManager()->persist($newsletterList);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl("tscms_newsletter_newsletterlist_index"));
        }
        return array(
            "form" => $form->createView()
        );
    }

    /**
     * @Route("/edit/{id}")
     * @Secure("ROLE_ADMIN")
     * @Template("tsCMSNewsletterBundle:NewsletterList:newsletterlist.html.twig")
     */
    public function editAction(NewsletterList $newsletterList, Request $request)
    {
        $form = $this->createForm(new NewsletterListType(), $newsletterList);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirect($this->generateUrl("tscms_newsletter_newsletterlist_index"));
        }
        return array(
            "form" => $form->createView()
        );
    }

    /**
     * @Route("/delete/{id}")
     * @Secure("ROLE_ADMIN")
     */
    public function deleteAction(NewsletterList $newsletterList)
    {
        $this->getDoctrine()->getManager()->remove($newsletterList);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirect($this->generateUrl("tscms_newsletter_newsletterlist_index"));
    }
}
