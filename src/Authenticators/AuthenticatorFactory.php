<?php

/*
 * This file is part of Laravel Freshdesk.
 *
 * (c) Bob Fridley <bobfridley@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BobFridley\Freshdesk\Authenticators;

use InvalidArgumentException;

/**
 * This is the authenticator factory class.
 *
 * @author Bob Fridley <bobfridley@gmail.com>
 */
class AuthenticatorFactory
{
    /**
     * Make a new authenticator instance.
     *
     * @param string $method
     *
     * @return \BobFridley\Freshdesk\Authenticators\AuthenticatorInterface
     */
    public function make($method)
    {
        switch ($method) {
            case 'password':
                return new PasswordAuthenticator();
        }

        throw new InvalidArgumentException("Unsupported authentication method [$method].");
    }
}
