<?php

/*
 * This file is part of the LyraContentBundle package.
 *
 * Copyright 2011 Massimo Giagnoni <gimassimo@gmail.com>
 *
 * This source file is subject to the MIT license. Full copyright and license
 * information are in the LICENSE file distributed with this source code.
 */

namespace Lyra\ContentBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Controller to show content in frontend.
 */
class MainController extends ContainerAware
{
    /**
     * Displays a content item.
     *
     * @param string $path node path
     */
    public function showAction($locale, $path)
    {
        $path = $this->container->get('lyra_content.node_manager')
            ->findPublishedPathNodes(trim($path, '/'));

        if (false === $path) {
            throw new NotFoundHttpException('Page not found!');
        }

        $node = end($path);
        $types = $this->container->getParameter('lyra_content.types');
        $contentBundle = $types[$node->getItemType()]['bundle'];

        $item = $this->container->get('lyra_content.node_manager')
            ->findNodeContent($node);

        return $this->container
            ->get('templating')
            ->renderResponse($contentBundle . ':Main:show.html.twig', array(
                'node' => $node,
                'path' => $path,
                'item' => $item
            ));
    }

    /**
     * Displays home page content
     */
    public function homeAction()
    {
        $node = $this->container->get('lyra_content.node_manager')
            ->findRootNode();

        if (null === $node) {
            throw new NotFoundHttpException('Page not found!');
        }

        $types = $this->container->getParameter('lyra_content.types');
        $contentBundle = $types[$node->getItemType()]['bundle'];

        $item = $this->container->get('lyra_content.node_manager')
            ->findNodeContent($node);

        return $this->container->get('templating')
            ->renderResponse($contentBundle . ':Main:show.html.twig', array(
                'node' => $node,
                'path' => array(),
                'item' => $item
            ));
    }

    /**
     * Displays navigation links.
     *
     * A list of links to descendants of a given parent node (up to a
     * given max depth) optionally including the parent itself.
     *
     * @param NodeInterface $parent parent node
     * @param integer $depth max depth (i.e. 1 = only direct descendants)
     * @param Boolean $addParent true = prepend $parent to the list of links
     */
    public function navigationAction($parent, $depth = 1, $addParent = false)
    {
        if (null === $parent) {
            $parent = $this->container->get('lyra_content.node_manager')
                ->findRootNode();
        }

        $nodes = $this->container->get('lyra_content.node_manager')
            ->findNodePublishedDescendantsFilteredByDepth($parent, $depth);

        if ($addParent) {
            array_unshift($nodes, $parent);
        }

        return $this->container->get('templating')
            ->renderResponse('LyraContentBundle:Main:navigation.html.twig', array(
                'nodes' => $nodes
            ));
    }
}
