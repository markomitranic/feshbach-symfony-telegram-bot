<?php

namespace App\Entity\BotBase;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", indexes={@ORM\Index(name="username", columns={"username"})})
 * @ORM\Entity
 */
class User
{
    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_bot", type="boolean", nullable=true, options={"comment"="True if this user is a bot"})
     */
    private $isBot = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255, nullable=false, options={"fixed"=true,"comment"="User's first name"})
     */
    private $firstName = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="last_name", type="string", length=255, nullable=true, options={"fixed"=true,"comment"="User's last name"})
     */
    private $lastName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="username", type="string", length=191, nullable=true, options={"fixed"=true,"comment"="User's username"})
     */
    private $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="language_code", type="string", length=10, nullable=true, options={"fixed"=true,"comment"="User's system language"})
     */
    private $languageCode;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"comment"="Entry date creation"})
     */
    private $createdAt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true, options={"comment"="Entry date update"})
     */
    private $updatedAt;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\BotBase\Chat", inversedBy="user")
     * @ORM\JoinTable(name="user_chat",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="chat_id", referencedColumnName="id")
     *   }
     * )
     */
    private $chat;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->chat = new \Doctrine\Common\Collections\ArrayCollection();
    }

}