<?php

namespace App\Http\Controllers;

use App\Http\Requests\FieldRequest;
use App\Services\Distance\Distance;
use Illuminate\Http\Request;

class LevenshteinController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/levenshtein/submit",
     *     description="Levenshtein distance calculation",
     *     @OA\Parameter(
     *         name="first_string",
     *         in="query",
     *         description="First string",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="second_string",
     *          in="query",
     *         description="First string",
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Success",
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Error: The input must be at least 2 characters.",
     *     ),
     * )
     * @param Request $request
     * @param Distance $distance
     * @return \Illuminate\Http\JsonResponse
     */
    public function distance(FieldRequest $request, Distance $distance)
    {
        $distance->setStrings($request->first_string, $request->second_string);

        return response()->json([
            'status' => 'ok',
            'value' => $distance->distanceLevenshtein(),
        ]);
    }
}
