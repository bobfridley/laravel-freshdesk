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
use Freshdesk\Client;
use BobFridley\Freshdesk\FreshdeskFactory;
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
/**
 * This is the freshdesk factory test class.
 *
 * @author Bob Fridley <robert.fridley@gmail.com>
 */
class FreshdeskFactoryTest extends AbstractTestBenchTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getFreshdeskFactory();
        $return = $factory->make(['username' => 'your-username', 'password' => 'your-password']);
        $this->assertInstanceOf(Client::class, $return);
    }
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The freshdesk client requires authentication.
     */
    public function testMakeWithoutUsername()
    {
        $factory = $this->getFreshdeskFactory();
        $factory->make(['password' => 'your-password']);
    }
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The freshdesk client requires authentication.
     */
    public function testMakeWithoutPassword()
    {
        $factory = $this->getFreshdeskFactory();
        $factory->make(['password' => 'your-username']);
    }
    protected function getFreshdeskFactory()
    {
        return new FreshdeskFactory();
    }
}
