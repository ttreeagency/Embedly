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
     * @Flow\InjectConfiguration(package="Ttree.Embedly")
     * @var array
     */
    protected $settings;

    /**
     * @param array $args
     */
    public function __construct(array $args)
    {
        $this->key = $this->settings['apiKey'];
        parent::__construct($args);
    }

}
