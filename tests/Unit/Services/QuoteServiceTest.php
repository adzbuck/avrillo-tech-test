<?php

namespace Tests\Unit\Services;

use App\Services\CacheService;
use App\Services\CelebrityQuotes\CelebrityQuotesManager;
use App\Services\QuoteService;
use Closure;
use Illuminate\Support\Collection;
use Tests\TestCase;

class QuoteServiceTest extends TestCase
{
    public function test_fetch_five_quotes_returns_quotes()
    {
        $givenQuotes = [
            'All you have to be is yourself',
            'Keep squares out yo circle',
            'Manga all day',
            'I\'m a creative genius',
            'We all self-conscious. I\'m just the first to admit it.',
        ];

        $celebrityQuotesManager = $this->getMockBuilder(CelebrityQuotesManager::class)
            ->disableOriginalConstructor()
            ->addMethods(['getQuote'])
            ->getMock();

        $celebrityQuotesManager
            ->expects($this->exactly(5))
            ->method('getQuote')
            ->willReturnOnConsecutiveCalls(...$givenQuotes);

        $cacheMock = $this->getMockBuilder(CacheService::class)
            ->getMock();

        $cacheMock
            ->expects($this->once())
            ->method('rememberForever')
            ->with(QuoteService::QUOTE_SERVER_CACHE_KEY)
            ->willReturnCallback(function (string $key, Closure $closure) {
                return $closure();
            });

        $quoteService = new QuoteService(
            $celebrityQuotesManager,
            $cacheMock,
        );

        $actualResult = $quoteService->fetchFiveQuotes();

        $this->assertInstanceOf(Collection::class, $actualResult);
        $this->assertEquals($givenQuotes, $actualResult->toArray());
    }

    public function test_clear_cache_calls_forget()
    {
        $celebrityQuotesManager = $this->getMockBuilder(CelebrityQuotesManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $cacheMock = $this->getMockBuilder(CacheService::class)
            ->getMock();

        $cacheMock
            ->expects($this->once())
            ->method('forget')
            ->with(QuoteService::QUOTE_SERVER_CACHE_KEY);

        $quoteService = new QuoteService(
            $celebrityQuotesManager,
            $cacheMock,
        );

        $quoteService->clearCache();
    }

    public function test_fetch_five_fresh_quotes_clears_cache_and_returns_quotes()
    {
        $givenQuotes = [
            'All you have to be is yourself',
            'Keep squares out yo circle',
            'Manga all day',
            'I\'m a creative genius',
            'We all self-conscious. I\'m just the first to admit it.',
        ];

        $celebrityQuotesManager = $this->getMockBuilder(CelebrityQuotesManager::class)
            ->disableOriginalConstructor()
            ->addMethods(['getQuote'])
            ->getMock();

        $celebrityQuotesManager
            ->expects($this->exactly(5))
            ->method('getQuote')
            ->willReturnOnConsecutiveCalls(...$givenQuotes);

        $cacheMock = $this->getMockBuilder(CacheService::class)
            ->getMock();

        $cacheMock
            ->expects($this->once())
            ->method('forget')
            ->with(QuoteService::QUOTE_SERVER_CACHE_KEY);

        $cacheMock
            ->expects($this->once())
            ->method('rememberForever')
            ->with(QuoteService::QUOTE_SERVER_CACHE_KEY)
            ->willReturnCallback(function (string $key, Closure $closure) {
                return $closure();
            });

        $quoteService = new QuoteService(
            $celebrityQuotesManager,
            $cacheMock,
        );

        $actualResult = $quoteService->fetchFiveFreshQuotes();

        $this->assertInstanceOf(Collection::class, $actualResult);
        $this->assertEquals($givenQuotes, $actualResult->toArray());
    }
}
