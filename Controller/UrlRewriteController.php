<?php

/**
 * @copyright EveryWorkflow. All rights reserved.
 */

declare(strict_types=1);

namespace EveryWorkflow\UrlRewriteBundle\Controller;

use EveryWorkflow\UrlRewriteBundle\Resolver\RouteResolverInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UrlRewriteController extends AbstractController
{
    protected RouteResolverInterface $routeResolver;
    protected LoggerInterface $logger;

    public function __construct(RouteResolverInterface $routeResolver, LoggerInterface $logger)
    {
        $this->routeResolver = $routeResolver;
        $this->logger = $logger;
    }

    /**
     * @Route(
     *     path="api/url-rewrite/{url}",
     *     requirements={"wildcard": ".*"},
     *     name="api.url_rewrite.get",
     *     methods="GET"
     * )
     */
    public function __invoke(string $url, Request $request): Response
    {
        try {
            return $this->routeResolver->resolve($url, $request);
        } catch (\Exception $e) {
            $this->logger->alert($e->getMessage());
        }
        return new Response();
    }
}
