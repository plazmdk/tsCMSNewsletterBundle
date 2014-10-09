<?php
/**
 * Created by PhpStorm.
 * User: plazm
 * Date: 4/16/14
 * Time: 5:04 PM
 */

namespace tsCMS\NewsletterBundle\Services;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Translation\Translator;
use tsCMS\NewsletterBundle\Entity\NewsletterList;
use tsCMS\NewsletterBundle\Entity\NewsletterListSubscriber;
use tsCMS\SystemBundle\Event\BuildSiteStructureEvent;
use tsCMS\SystemBundle\Model\SiteStructureAction;
use tsCMS\SystemBundle\Model\SiteStructureGroup;
use tsCMS\TemplateBundle\Entity\Template;
use tsCMS\TemplateBundle\Event\GetTemplateTypesEvent;
use tsCMS\TemplateBundle\Model\TemplateType;
use tsCMS\TemplateBundle\tsCMSTemplateEvents;

class NewsletterService {
    /** @var \Doctrine\ORM\EntityManager  */
    private $em;
    /** @var RouterInterface */
    private $router;
    /** @var \Symfony\Component\Translation\Translator */
    private $translator;

    function __construct(EntityManager $em, RouterInterface $router, Translator $translator)
    {
        $this->em = $em;
        $this->router = $router;
        $this->translator = $translator;
    }


    public function onBuildSiteStructure(BuildSiteStructureEvent $event) {
        $pagesElement = new SiteStructureGroup("Nyhedsbrev","fa-envelope-o");
        $pagesElement->addElement(new SiteStructureAction($this->translator->trans("newsletterlists"),$this->router->generate("tscms_newsletter_newsletterlist_index")));

        $event->addElement($pagesElement);
    }

    /**
     * @return NewsletterList[]
     */
    public function getNewsletterLists() {
        $qb = $this->em->getRepository("tsCMSNewsletterBundle:NewsletterList")->createQueryBuilder("nl");
        $qb->select("nl, count(s) AS subscriberCount");
        $qb->leftJoin("nl.subscribers","s");

        return $qb->getQuery()->getResult();
    }

    public function addSubscriber($newsletterId, $name, $email)
    {
        $repository = $this->em->getRepository("tsCMSNewsletterBundle:NewsletterList");
        /** @var Newsletterlist $newsletterList */
        $newsletterList = $repository->find($newsletterId);

        $existing = $this->em->getRepository("tsCmsNewsletterBundle:NewsletterListSubscriber")->findOneBy(array(
            "email" => $email,
            "newsletterList" => $newsletterList
        ));

        if (!$existing) {
            $subscriber = new NewsletterListSubscriber();
            $subscriber->setEmail($email);
            $subscriber->setName($name);
            $newsletterList->addSubscriber($subscriber);

            $this->em->persist($subscriber);
            $this->em->flush($subscriber);
        }
    }
} 