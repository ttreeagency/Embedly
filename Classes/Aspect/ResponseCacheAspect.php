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
use TYPO3\Flow\Reflection\ObjectAccess;

/**
 * Response Cache Aspect
 *
 * @Flow\Scope("singleton")
 * @Flow\Aspect
 */
class ResponseCacheAspect
{

    /**
     * @Flow\Inject
     * @var VariableFrontend
     */
    protected $responseCache;

    /**
     * @Flow\Inject
     * @var SystemLoggerInterface
     */
    protected $systemLogger;

    /**
     * @Flow\Around("setting(Ttree.Embedly.logApiRequest) && within(Ttree\Embedly\Embedly) && method(public .*->(oembed|preview|objectify|extract|services)())")
     * @param JoinPointInterface $joinPoint The current join point
     * @return mixed
     */
    public function getResponseFromCache(JoinPointInterface $joinPoint)
    {
        $proxy = $joinPoint->getProxy();
        $key = ObjectAccess::getProperty($proxy, 'key');
        $params = $joinPoint->getMethodArgument('params');
        $cacheKey = md5($joinPoint->getClassName() . $joinPoint->getMethodName() . $key . json_encode($params));
        if ($this->responseCache->has($cacheKey)) {
            $this->systemLogger->log(sprintf('   cache hit Embedly::%s', $joinPoint->getMethodName()), LOG_DEBUG);
            return $this->responseCache->get($cacheKey);
        } else {
            $this->systemLogger->log(sprintf('   cache miss Embedly::%s', $joinPoint->getMethodName()), LOG_DEBUG);
        }
        $response = $joinPoint->getAdviceChain()->proceed($joinPoint);
        $this->responseCache->set($cacheKey, $response);
        return $response;
    }
}
