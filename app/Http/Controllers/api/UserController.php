<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller {
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function index(): JsonResponse {
        $users = $this->userRepository->all();
        return response()->json($users);
    }

    public function store(UserRequest $request): JsonResponse {
        $user = $this->userRepository->create($request->validated());
        return response()->json($user, 201);
    }

    public function show($id): JsonResponse {
        $user = $this->userRepository->findById($id);
        return response()->json($user);
    }

    public function update(UserRequest $request, $id): JsonResponse {
        $user = $this->userRepository->update($id, $request->validated());
        return response()->json($user);
    }

    public function destroy($id): JsonResponse {
        $this->userRepository->delete($id);
        return response()->json(null, 204);
    }
}
