<?php

namespace xRayLaravel\Tests;

use Orchestra\Testbench\TestCase;
use xRayLaravel\Facades\xRay;
use xRayLaravel\xRayLoggerServiceProvider;
use xRayLog\xRayLogger;
use xRayLaravel\xRayHandler;
use Mockery;

class XRayTest extends TestCase
{
    protected $mockLogger;
    protected $handler;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->mockLogger = Mockery::mock(xRayLogger::class);
        
        // Define the mock methods
        $this->mockLogger->shouldReceive('info')->byDefault()->andReturn(null);
        $this->mockLogger->shouldReceive('error')->byDefault()->andReturn(null);
        $this->mockLogger->shouldReceive('warning')->byDefault()->andReturn(null);
        $this->mockLogger->shouldReceive('debug')->byDefault()->andReturn(null);
        
        $this->handler = new xRayHandler($this->mockLogger);
        
        $this->app->instance(xRayLogger::class, $this->mockLogger);
        $this->app->instance('xRay', $this->handler);
        
        // Disable actual HTTP calls in xray_setup
        $this->app['config']->set('app.env', 'testing');
    }

    protected function getPackageProviders($app)
    {
        return [xRayLoggerServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'xRay' => xRay::class,
        ];
    }

    /** @test */
    public function it_can_log_info_message()
    {
        $this->mockLogger->shouldReceive('info')
            ->once()
            ->with('Test info message')
            ->andReturn(null);

        $result = $this->handler->setPayload('Test info message');
        $this->assertInstanceOf(xRayHandler::class, $result);
    }

    /** @test */
    public function it_can_log_error_message()
    {
        $this->mockLogger->shouldReceive('error')
            ->once()
            ->with('Test error message')
            ->andReturn(null);

        $result = $this->handler->setPayload('Test error message')->error();
        $this->assertInstanceOf(xRayHandler::class, $result);
    }

    /** @test */
    public function it_can_log_warning_message()
    {
        $this->mockLogger->shouldReceive('warning')
            ->once()
            ->with('Test warning message')
            ->andReturn(null);

        $result = $this->handler->setPayload('Test warning message')->warning();
        $this->assertInstanceOf(xRayHandler::class, $result);
    }

    /** @test */
    public function it_can_log_debug_message()
    {
        $this->mockLogger->shouldReceive('debug')
            ->once()
            ->with('Test debug message')
            ->andReturn(null);

        $result = $this->handler->setPayload('Test debug message')->debug();
        $this->assertInstanceOf(xRayHandler::class, $result);
    }

    /** @test */
    public function it_can_chain_methods()
    {
        $this->mockLogger->shouldReceive('info')
            ->once()
            ->with('First message')
            ->andReturn(null);

        $this->mockLogger->shouldReceive('warning')
            ->once()
            ->with('First message')
            ->andReturn(null);

        $this->mockLogger->shouldReceive('error')
            ->once()
            ->with('First message')
            ->andReturn(null);

        $this->mockLogger->shouldReceive('debug')
            ->once()
            ->with('First message')
            ->andReturn(null);

        $result = $this->handler->setPayload('First message')
            ->warning()
            ->error()
            ->debug();
            
        $this->assertInstanceOf(xRayHandler::class, $result);
        Mockery::close();
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
