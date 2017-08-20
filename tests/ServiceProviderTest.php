<?php
/*
 * This file is part of Laravel Freshdesk.
 *
 * (c) Bob Fridley <bobfridley@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace BobFridley\Tests\Freshdesk;
use Freshdesk\Client;
use BobFridley\Freshdesk\FreshdeskFactory;
use BobFridley\Freshdesk\FreshdeskManager;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
/**
 * This is the service provider test class.
 *
 * @author Bob Fridley <bobfridley@gmail.com>
 */
class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;
    
    public function testFreshdeskFactoryIsInjectable()
    {
        $this->assertIsInjectable(FreshdeskFactory::class);
    }
    public function testFreshdeskManagerIsInjectable()
    {
        $this->assertIsInjectable(FreshdeskManager::class);
    }
    public function testBindings()
    {
        $this->assertIsInjectable(Client::class);
        $original = $this->app['freshdesk.connection'];
        $this->app['freshdesk']->reconnect();
        $new = $this->app['freshdesk.connection'];
        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}