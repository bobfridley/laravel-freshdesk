<?php

/*
 * This file is part of Laravel Freshdesk.
 *
 * (c) Bob Fridley <robert.fridley@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BobFridley\Freshdesk;

use GrahamCampbell\Manager\AbstractManager;
use Illuminate\Contracts\Config\Repository;

/**
 * This is the freshdesk manager class.
 *
 * # freshdesk endpoints
 * https://my.freshdeskbusiness.com/appserver/rest/user/null (auth)
 * https://my.freshdeskbusiness.com/presence/rest/clicktocall/[phonenumber]
 * https://my.freshdeskbusiness.com/presence/rest/directory
 * https://my.freshdeskbusiness.com/presence/rest/extension/[extension-number]
 * https://my.freshdeskbusiness.com/presence/rest/callhistory/[extension number][?parameterlist]
 * https://my.freshdeskbusiness.com/presence/dashui[?filterExtension=[extensionlist]&firstRequest=true]
 * https://my.freshdeskbusiness.com/presence/rest/callrecording/[presenceCallId]
 * https://my.freshdeskbusiness.com/presence/rest/conference/[extension-number]
 * https://my.freshdeskbusiness.com/presence/rest/queue/[extension-number]
 *
 * @author BobFridley <robert.fridley@gmail.com>
 */
class FreshdeskManager extends AbstractManager
{
    /**
     * The factory instance.
     *
     * @var \BobFridley\Freshdesk\FreshdeskFactory
     */
    protected $factory;

    /**
     * Create a new freshdesk manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @param \BobFridley\Freshdesk\FreshdeskFactory        $factory
     *
     * @return void
     */
    public function __construct(Repository $config, FreshdeskFactory $factory)
    {
        parent::__construct($config);
        $this->factory = $factory;
    }

    /**
     * Create the connection instance.
     *
     * @param array $config
     *
     * @return \Freshdesk\Client
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * Get the configuration name.
     *
     * @return string
     */
    protected function getConfigName()
    {
        return 'freshdesk';
    }

    /**
     * Get the factory instance.
     *
     * @return \BobFridley\Freshdesk\FreshdeskFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}
