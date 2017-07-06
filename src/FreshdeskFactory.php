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

use Freshdesk\Client;
use InvalidArgumentException;
/**
 * This is the freshdesk factory class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
class FreshdeskFactory
{
    /**
     * Make a new freshdesk client.
     *
     * @param string[] $config
     *
     * @return \Freshdesk\Client
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);
        return $this->getClient($config);
    }
    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return string[]
     */
    protected function getConfig(array $config)
    {
        if (!array_key_exists('username', $config) || !array_key_exists('password', $config)) {
            throw new InvalidArgumentException('The freshdesk client requires authentication.');
        }
        return array_only($config, ['username', 'password']);
    }
    /**
     * Get the freshdesk client.
     *
     * @param string[] $auth
     *
     * @return \Freshdesk\Client
     */
    protected function getClient(array $auth)
    {
        return new Client($auth['username'], $auth['password']);
    }
}