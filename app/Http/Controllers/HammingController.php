<?php

namespace App\Http\Controllers;

use App\Http\Requests\FieldRequest;
use App\Services\Distance\Distance;
use Illuminate\Http\Request;


class HammingController extends Controller
{
    /**
     *@OA\Post(
     *     path="/api/hamming/submit",
     *     description="Hamming distance calculation",
     *     @OA\Parameter(
     *         name="first_string",
     *         in="query",
     *         description="First string",
     *         required=true,
     *     ),
     *     @OA\Parameter(
     *         name="second_string",
     *         description="First string",
     *         in="query",
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
    public function distance(Distance $distance, FieldRequest $request)
    {

        $distance->setStrings($request->first_string, $request->second_string);

        return response()->json([
            'status' => 'ok',
            'value' => $distance->distanceHamming()
        ]);
    }
}
