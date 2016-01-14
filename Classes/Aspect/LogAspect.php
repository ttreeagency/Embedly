<?php
namespace Ttree\Embedly\Aspect;

/*
 * This file is part of the Ttree.Embedly package.
 *
 * (c) ttree ltd - www.ttree.ch
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Aop\JoinPointInterface;
use TYPO3\Flow\Cache\Frontend\VariableFrontend;
use TYPO3\Flow\Log\SystemLoggerInterface;

/**
 * Log API Request Aspect
 *
 * @Flow\Scope("singleton")
 * @Flow\Aspect
 */
class LogAspect
{
    /**
     * @Flow\Inject
     * @var SystemLoggerInterface
     */
    protected $systemLogger;

    /**
     * @Flow\Before("setting(Ttree.Embedly.logApiRequest) && within(Ttree\Embedly\Embedly) && method(public .*->(oembed|preview|objectify|extract|services)())")
     * @param JoinPointInterface $joinPoint The current join point
     * @return void
     */
    public function log(JoinPointInterface $joinPoint)
    {
        $this->systemLogger->log(sprintf('-> call Embedly::%s', $joinPoint->getMethodName()), LOG_DEBUG);
    }
}
