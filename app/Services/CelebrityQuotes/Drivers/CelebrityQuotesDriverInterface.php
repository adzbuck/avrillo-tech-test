<?php

namespace App\Services\CelebrityQuotes\Drivers;

interface CelebrityQuotesDriverInterface
{
    public function getQuote(): string;
}
