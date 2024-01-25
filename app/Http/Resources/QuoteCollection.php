<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;
use OpenApi\Attributes as OA;

#[OA\Schema(
    description: "List quotes",
    properties: [
        new OA\Property(
            property: 'data',
            description: 'Array of all quotes',
            type: 'array',
        ),
    ],
    type: 'object'
)]
class QuoteCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray(Request $request): array|JsonSerializable|Arrayable
    {
        return $this->collection;
    }
}
