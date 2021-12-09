<?php

namespace App\Http\Controllers;

use App\Helpers\Errors\ServerErrors;
use App\Services\Contracts\ImLearnService;
use Illuminate\Http\Request;

class mLearnController extends Controller
{
    protected $mLearnService;
    public function __construct(ImLearnService $mLearnService)
    {
        $this->mLearnService = $mLearnService;
    }

    /**
     * @OA\Get (
     *     path="/m-learn/user",
     *     tags={"m-Learn"},
     *     summary="show user grupos",
     *     operationId="showUserGroup",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Parameter(in="query", name="msisdn", required=false, @OA\Schema(type="string")),
     *     @OA\Parameter(in="query", name="userId", required=false, @OA\Schema(type="string")),
     *     security={{"BearerAuth":{}}},
     *
     * )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function findUser(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $msisdn = $request->get('msisdn') ?: null;
            $userId = $request->get('userId') ?: null;
            return response()->json($this->mLearnService->findUserWithMLearn($userId, $msisdn));
        }catch (\Exception $e)
        {
            return response()->json([
                'message' => ServerErrors::getError(ServerErrors::ERROR_1001),
                'code' => ServerErrors::ERROR_1001,
                'error' => $e->getMessage()
            ], 403);
        }

    }

    /**
     * @OA\Get (
     *     path="/m-learn/group-user",
     *     tags={"m-Learn"},
     *     summary="show user grupos",
     *     operationId="showUserGroup",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\Parameter(in="query", name="userId", required=false, @OA\Schema(type="string")),
     *     security={{"BearerAuth":{}}},
     *
     * )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserGroups(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $userId = $request->get('userId') ?: null;
            return response()->json($this->mLearnService->getUserGroupWithMLearn($userId));
        }catch (\Exception $e)
        {
            return response()->json([
                'message' => ServerErrors::getError(ServerErrors::ERROR_1001),
                'code' => ServerErrors::ERROR_1001,
                'error' => $e->getMessage()
            ], 403);
        }

    }
}
