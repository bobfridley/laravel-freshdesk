<?php

/*
 * This file is part of Laravel Freshdesk.
 *
 * (c) Bob Fridley <bobfridley@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BobFridley\Freshdesk\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the freshdesk facade class.
 *
 * @author Bob Fridley <bobfridley@gmail.com>
 */
class Freshdesk extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'freshdesk';
    }
}
