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
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Illuminate\Contracts\Config\Repository;
use Mockery;
/**
 * This is the freshdesk manager test class.
 *
 * @author Bob Fridley <bobfridley@gmail.com>
 */
class FreshdeskManagerTest extends AbstractTestBenchTestCase
{
    public function testCreateConnection()
    {
        $config = ['path' => __DIR__];
        $manager = $this->getManager($config);
        $manager->getConfig()->shouldReceive('get')->once()
            ->with('freshdesk.default')->andReturn('freshdesk');
        $this->assertSame([], $manager->getConnections());
        $return = $manager->connection();
        $this->assertInstanceOf('Freshdesk\Client', $return);
        $this->assertArrayHasKey('freshdesk', $manager->getConnections());
    }
    protected function getManager(array $config)
    {
        $repo = Mockery::mock(Repository::class);
        $factory = Mockery::mock(FreshdeskFactory::class);
        $manager = new FreshdeskManager($repo, $factory);
        $manager->getConfig()->shouldReceive('get')->once()
            ->with('freshdesk.connections')->andReturn(['freshdesk' => $config]);
        $config['name'] = 'freshdesk';
        $manager->getFactory()->shouldReceive('make')->once()
            ->with($config)->andReturn(Mockery::mock(Client::class));
        return $manager;
    }
}