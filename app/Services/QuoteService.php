<?php

namespace App\Services;

use App\Interfaces\CacheInterface;
use App\Services\CelebrityQuotes\CelebrityQuotesManager;
use Illuminate\Support\Collection;

class QuoteService
{
    public const QUOTE_SERVER_CACHE_KEY = 'QuoteServiceFetchFiveQuotes';

    public function __construct(
        private readonly CelebrityQuotesManager $celebrityQuotesManager,
        private readonly CacheInterface $cache,
    ) {
    }

    /**
     * @return Collection<int, string>
     */
    public function fetchFiveQuotes(): Collection
    {
        return $this->cache->rememberForever(self::QUOTE_SERVER_CACHE_KEY, function () {
            $quotes = collect();

            for($i = 1; $i <= 5; $i++) {
                $quotes->add($this->celebrityQuotesManager->getQuote());
            }

            return $quotes;
        });
    }

    public function clearCache(): void
    {
        $this->cache->forget(self::QUOTE_SERVER_CACHE_KEY);
    }

    /**
     * @return Collection<int, string>
     */
    public function fetchFiveFreshQuotes(): Collection
    {
        $this->clearCache();

        return $this->fetchFiveQuotes();
    }
}
