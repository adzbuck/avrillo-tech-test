<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuoteCollection;
use App\Services\QuoteService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

class QuoteController extends Controller
{
    public function __construct(
        public readonly QuoteService $quoteService
    ) {
    }

    #[OA\Get(
        path: "/api/quotes",
        summary: "List five quotes",
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "OK",
                content: new OA\JsonContent(
                    ref: '#/components/schemas/QuoteCollection',
                ),
            ),
            new OA\Response(
                ref: '#/components/responses/InternalServerError',
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
            ),
            new OA\Response(
                ref: '#/components/responses/UnauthorisedServerError',
                response: Response::HTTP_UNAUTHORIZED,
            )
        ]
    )]
    public function index(Request $request): QuoteCollection
    {
        if ($request->route('clearCache', false)) {
            $this->quoteService->clearCache();
        }

        return new QuoteCollection(
            $this->quoteService->fetchFiveQuotes()
        );
    }

    #[OA\Put(
        path: "/api/quotes",
        summary: "Get a new list of five quotes",
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "OK",
                content: new OA\JsonContent(
                    ref: '#/components/schemas/QuoteCollection',
                ),
            ),
            new OA\Response(
                ref: '#/components/responses/InternalServerError',
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
            ),
            new OA\Response(
                ref: '#/components/responses/UnauthorisedServerError',
                response: Response::HTTP_UNAUTHORIZED,
            )
        ]
    )]
    public function update(): QuoteCollection
    {
        return new QuoteCollection(
            $this->quoteService->fetchFiveFreshQuotes()
        );
    }

    #[OA\Delete(
        path: "/api/quotes",
        summary: "Clear current quotes",
        responses: [
            new OA\Response(
                response: Response::HTTP_NO_CONTENT,
                description: "OK",
            ),
            new OA\Response(
                ref: '#/components/responses/InternalServerError',
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
            ),
            new OA\Response(
                ref: '#/components/responses/UnauthorisedServerError',
                response: Response::HTTP_UNAUTHORIZED,
            )
        ]
    )]
    public function destroy(): Response
    {
        $this->quoteService->clearCache();

        return response()->noContent();
    }
}
