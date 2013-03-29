<?php

/*
 * This file is part of the LyraContentBundle package.
 * 
 * Copyright 2011 Massimo Giagnoni <gimassimo@gmail.com>
 *
 * This source file is subject to the MIT license. Full copyright and license
 * information are in the LICENSE file distributed with this source code.
 */
## alter table node add column roles character varying[];


namespace Lyra\ContentBundle\Entity;

use Lyra\ContentBundle\Model\Node as AbstractNode;

/**
 * Node entity
 */
class Node extends AbstractNode
{
    /**
     * @var integer
     */
    protected $lft;

    /**
     * @var integer
     */
    protected $rgt;

    /**
     * @var integer
     */
    protected $lvl;
    
    private $language;
    
    /**
     * @var pgarray $roles
     * 
     */
    protected $roles;

    public function getLeft()
    {
        return $this->lft;
    }

    public function getRight()
    {
        return $this->rgt;
    }

    public function getLevel()
    {
        return $this->lvl;
    }

    public function isRoot()
    {
        return 0 === $this->getLevel();
    }

    public function isFirstChild() 
    {
        return !$this->isRoot() && 1 === $this->getLeft() - $this->getParent()->getLeft();
    }

    public function isLastChild()
    {
        return !$this->isRoot() && 1 === $this->getParent()->getRight() - $this->getRight();
    }
    
    public function getDepth()
    {
        return $this->lvl;
    }

    public function __toString()
    {
        return str_repeat('- ', $this->getLevel()) . $this->getTitle();
    }
    
    public function setTranslatableLanguage($language)
    {
        $this->language = $language;
    }
    
    /**
     * Add role
     *
     * @param string $roles
     */
    public function addRoles($roles) {
        $this->roles[] = $roles;
    }

    /**
     * Set role
     *
     * @param string $roles
     */
    public function setRoles($roles)
    {
        // vendor/symfony/src/Symfony/Component/Form/Util/PropertyPath.php
        // can't select between  add# & set#.
        if(is_string($roles)) {
            $this->addRoles($roles);
        } else {
            $this->roles = $roles;
        }
    }

    /**
     * Get roles
     *
     * @return pgarray 
     */
    public function getRoles($index = null)
    {
         if(!is_null($this->roles) && !is_null($index)
           and array_key_exists($index, $this->roles)) {
            return $this->roles[$index];
        } else {
            return $this->roles;
        }
    }
    
}
