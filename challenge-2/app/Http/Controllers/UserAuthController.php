<?php

namespace App\Http\Controllers;

use App\Helpers\Errors\ServerErrors;
use App\Services\Contracts\IUserService;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    protected $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @OA\Post(
     *     path="/auth/register",
     *     tags={"Auth"},
     *     summary="Registro de novos usuarios",
     *     operationId="registerUser",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *         type="object",
     *          @OA\Property(property="msisdn", type="string"),
     *          @OA\Property(property="name", type="string"),
     *          @OA\Property(property="password", type="string"),
     *          )
     *     )
     * )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $user = (object)$request->only([
                'msisdn',
                'name',
                'password'
            ]);

            return response()->json($this->userService->registerUser($user->msisdn, $user->name, $user->password));
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
     * @OA\Post(
     *     path="/auth/login",
     *     tags={"Auth"},
     *     summary="Login usuarios",
     *     operationId="loginUser",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *         type="object",
     *          @OA\Property(property="msisdn", type="string"),
     *          @OA\Property(property="password", type="string"),
     *          )
     *     )
     * )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $user = (object)$request->only([
                'msisdn',
                'password'
            ]);

            return response()->json($this->userService->loginUser($user->msisdn, $user->password));
        }catch (\Exception $e)
        {
            return response()->json([
                'message' => ServerErrors::getError(ServerErrors::ERROR_1002),
                'code' => ServerErrors::ERROR_1002,
                'error' => $e->getMessage()
            ], 403);
        }

    }
}
