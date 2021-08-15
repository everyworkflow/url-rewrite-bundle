<?php

/**
 * @copyright EveryWorkflow. All rights reserved.
 */

declare(strict_types=1);

namespace EveryWorkflow\UrlRewriteBundle;

use EveryWorkflow\UrlRewriteBundle\DependencyInjection\UrlRewriteExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EveryWorkflowUrlRewriteBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new UrlRewriteExtension();
    }
}
