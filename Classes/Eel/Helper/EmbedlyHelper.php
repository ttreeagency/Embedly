<?php
namespace Ttree\Embedly\Eel\Helper;

/*
 * This file is part of the Ttree.Embedly package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Ttree\Embedly\Embedly;
use TYPO3\Eel\ProtectedContextAwareInterface;
use TYPO3\Flow\Annotations as Flow;

/**
 * Oembed Operation
 */
class EmbedlyHelper implements ProtectedContextAwareInterface
{
    /**
     * @param string $url
     * @return array
     */
    public function oembed($url)
    {
        $embedly = new Embedly();
        $response = $embedly->oembed([
            'url' => $url
        ]);
        $data = json_decode(json_encode(reset($response)), true);
        return $data;
    }

    /**
     * All methods are considered safe
     *
     * @param string $methodName
     * @return boolean
     */
    public function allowsCallOfMethod($methodName)
    {
        return true;
    }
}
