<?php
/*
 * This file is part of Laravel Freshdesk.
 *
 * (c) Bob Fridley <robert.fridley@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BobFridley\Tests\Freshdesk\Facades;
use BobFridley\Freshdesk\FreshdeskManager;
use BobFridley\Freshdesk\Facades\Freshdesk;
use GrahamCampbell\TestBenchCore\FacadeTrait;
use BobFridley\Tests\Freshdesk\AbstractTestCase;
/**
 * This is the freshdesk facade test class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
class FreshdeskTest extends AbstractTestCase
{
    use FacadeTrait;
    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'freshdesk';
    }
    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Freshdesk::class;
    }
    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return FreshdeskManager::class;
    }
}