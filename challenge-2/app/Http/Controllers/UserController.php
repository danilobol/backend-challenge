<?php

namespace App\Http\Controllers;

use App\Helpers\Errors\ServerErrors;
use App\Services\Contracts\IUserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @OA\Put(
     *     path="/user/upgrade",
     *     tags={"User"},
     *     summary="Upgrade user",
     *     operationId="upgradeUser",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *         type="object",
     *          @OA\Property(property="userId", type="string"),
     *          )
     *     )
     * )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upgrade(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $userId = $request->get('userId') ?: null;

            return response()->json($this->userService->upgradeUser($userId));
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
     * @OA\Put(
     *     path="/user/downgrade",
     *     tags={"User"},
     *     summary="downgrade user",
     *     operationId="downgradeUser",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *         type="object",
     *          @OA\Property(property="userId", type="string"),
     *          )
     *     )
     * )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function downgrade(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $userId = $request->get('userId') ?: null;

            return response()->json($this->userService->downgradeUser($userId));
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
     *     path="/user/showAll",
     *     tags={"User"},
     *     summary="show all user",
     *     operationId="showAllUser",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *
     * )
     * @param int $string
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json($this->userService->showAllUsers());
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
     *     path="/user/show/{id}",
     *     tags={"User"},
     *     summary="show user by id",
     *     operationId="showUserById",
     *     @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *
     * )
     * @param int $string
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json($this->userService->findUser($id));
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
