<?php

namespace Tests\Unit\Services;

use App\Interfaces\CacheInterface;
use App\Services\CacheService;
use Tests\TestCase;

class CacheServiceTest extends TestCase
{
    public function test_remember_forever_forwards_call()
    {
        $givenKey = 'testKey';
        $givenClosure = fn () => 'test';

        $cacheMock = $this->getMockBuilder(CacheInterface::class)
            ->getMock();

        $cacheMock
            ->expects($this->once())
            ->method('rememberForever')
            ->with($givenKey, $givenClosure)
            ->willReturn($givenClosure());

        $this->app->singleton(
            'cache',
            fn () => $cacheMock,
        );

        $cacheService = new CacheService();

        $actualResult = $cacheService->rememberForever($givenKey, $givenClosure);

        $this->assertEquals($givenClosure(), $actualResult);
    }

    public function test_forget_forwards_call()
    {
        $givenKey = 'testKey';

        $cacheMock = $this->getMockBuilder(CacheInterface::class)
            ->getMock();

        $cacheMock
            ->expects($this->once())
            ->method('forget')
            ->with($givenKey);

        $this->app->singleton(
            'cache',
            fn () => $cacheMock,
        );

        $cacheService = new CacheService();

        $actualResult = $cacheService->forget($givenKey);

        $this->assertIsBool($actualResult);
    }
}
