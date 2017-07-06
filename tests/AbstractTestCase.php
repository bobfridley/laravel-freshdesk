<?php
/*
 * This file is part of Laravel Freshdesk.
 *
 * (c) Bob Fridley <robert.fridley@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BobFridley\Tests\Freshdesk;
use BobFridley\Freshdesk\FreshdeskServiceProvider;
use GrahamCampbell\TestBench\AbstractPackageTestCase;
/**
 * This is the abstract test case class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
abstract class AbstractTestCase extends AbstractPackageTestCase
{
    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return FreshdeskServiceProvider::class;
    }
}