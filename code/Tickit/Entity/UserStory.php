<?php

namespace Ntq\Tickit\Entity;

class UserStory
{
    const PRIORITY_MINOR = 0;
    const PRIORITY_NORMAL = 1;
    const PRIORITY_IMPORTANT = 2;
    const PRIORITY_URGENT = 3;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $priority;

    /**
     * @var Member
     */
    private $assignee;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UserStory
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return UserStory
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return UserStory
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param int $priority
     * @return UserStory
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * @return Member
     */
    public function getAssignee()
    {
        return $this->assignee;
    }

    /**
     * @param Member $assignee
     * @return UserStory
     */
    public function setAssignee(Member $assignee)
    {
        $this->assignee = $assignee;
        return $this;
    }
}