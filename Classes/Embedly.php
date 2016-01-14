<?php
namespace Ttree\Embedly;

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

/**
 * @api
 */
class Embedly extends \Embedly\Embedly
{
    /**
     * @Flow\InjectConfiguration
     * @var array
     */
    protected $settings;

    /**
     * Initialize Object
     */
    public function initializeObject()
    {
        if ($this->key === null) {
            $this->key = $this->settings['apiKey'];
        }
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }
}
