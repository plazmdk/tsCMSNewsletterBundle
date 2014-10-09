<?php
/**
 * Created by PhpStorm.
 * User: plazm
 * Date: 7/26/14
 * Time: 3:13 PM
 */

namespace tsCMS\NewsletterBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="newsletterListSubscriber")
 */
class NewsletterListSubscriber {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var NewsletterList
     *
     * @ORM\ManyToOne(targetEntity="tsCMS\NewsletterBundle\Entity\NewsletterList", inversedBy="subscribers")
     * @ORM\JoinColumn(name="newsletterList_id", referencedColumnName="id")
     */
    protected $newsletterList;
    /**
     * @ORM\Column(type="string")
     */
    protected $name;
    /**
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
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
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param NewsletterList $newsletterList
     */
    public function setNewsletterList($newsletterList)
    {
        $this->newsletterList = $newsletterList;
    }

    /**
     * @return NewsletterList
     */
    public function getNewsletterList()
    {
        return $this->newsletterList;
    }


} 