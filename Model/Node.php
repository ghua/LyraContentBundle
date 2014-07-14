<?php

/*
 * This file is part of the LyraContentBundle package.
 *
 * Copyright 2011 Massimo Giagnoni <gimassimo@gmail.com>
 *
 * This source file is subject to the MIT license. Full copyright and license
 * information are in the LICENSE file distributed with this source code.
 */

namespace Lyra\ContentBundle\Model;

abstract class Node implements NodeInterface
{
    /**
     * @var mixed
     */
    protected $id;


    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $link_title;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var Boolean
     */
    protected $published;

    /**
     * @var string
     */
    protected $itemType;

    /**
     * @var mixed
     */
    protected $itemId;

    /**
     * @var NodeInterface
     */
    protected $parent;

    /**
     * @var Doctrine\Common\Collections\ArrayCollection
     */
    protected $children;
    
    /**
     * @var Page
     */
    protected $page;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getLinkTitle()
    {
        return $this->link_title;
    }

    public function setLinkTitle($linkTitle)
    {
        $this->link_title = $linkTitle;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function isPublished()
    {
        return $this->published;
    }

    public function setPublished($published)
    {
        $this->published = $published;
    }

    public function getItemType()
    {
        return $this->itemType;
    }

    public function setItemType($itemType)
    {
        $this->itemType = $itemType;
    }

    public function getItemId()
    {
        return $this->itemId;
    }

    public function setItemId($itemId)
    {
        $this->itemId= $itemId;
    }

    public function setParent(NodeInterface $parent)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function getChildren()
    {
        return $this->children;
    }
    
    public function getPage()
    {
        return $this->page;
    }
    
    public function setPage($page)
    {
        $this->page = $page;
    }
}
