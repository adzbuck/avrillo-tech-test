<?php

namespace App\Services\CelebrityQuotes;

use App\Services\CelebrityQuotes\Drivers\CelebrityQuotesDriverInterface;
use App\Services\CelebrityQuotes\Drivers\KanyeWestDriver;
use Illuminate\Support\Manager;

/**
 * @mixin CelebrityQuotesDriverInterface
 */
class CelebrityQuotesManager extends Manager
{
    public function createKanyeWestDriver(): CelebrityQuotesDriverInterface
    {
        return new KanyeWestDriver();
    }

    public function getDefaultDriver()
    {
        return $this->config->get('celebrity-quotes.driver', 'kanye-west');
    }
}
