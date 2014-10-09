<?php
/**
 * Created by PhpStorm.
 * User: plazm
 * Date: 7/26/14
 * Time: 3:13 PM
 */

namespace tsCMS\NewsletterBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="newsletterlist")
 */
class NewsletterList {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string")
     */
    protected $title;
    /**
     * @var NewsletterListSubscriber[]|ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="tsCMS\NewsletterBundle\Entity\NewsletterListSubscriber", mappedBy="newsletterList")
     */
    protected $subscribers;

    function __construct()
    {
        $this->subscribers = new ArrayCollection();
    }


    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param \tsCMS\NewsletterBundle\Entity\NewsletterListSubscriber $subscriber
     */
    public function addSubscriber($subscriber)
    {
        $this->subscribers->add($subscriber);
        $subscriber->setNewsletterList($this);
    }

    /**
     * @param \tsCMS\NewsletterBundle\Entity\NewsletterListSubscriber $subscriber
     */
    public function removeSubscriber($subscriber)
    {
        $this->subscribers->removeElement($subscriber);
        $subscriber->setNewsletterList(null);
    }

    /**
     * @return \tsCMS\NewsletterBundle\Entity\NewsletterListSubscriber[]
     */
    public function getSubscribers()
    {
        return $this->subscribers;
    }


} 