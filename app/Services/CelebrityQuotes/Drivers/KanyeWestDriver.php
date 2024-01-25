<?php

namespace App\Services\CelebrityQuotes\Drivers;

use Illuminate\Support\Facades\Http;

class KanyeWestDriver implements CelebrityQuotesDriverInterface
{
    public const QUOTE_API_URL = 'https://api.kanye.rest/';

    public function getQuote(): string
    {
        return Http::retry(3, 50)
            ->acceptJson()
            ->get(self::QUOTE_API_URL)
            ->json('quote');
    }
}
