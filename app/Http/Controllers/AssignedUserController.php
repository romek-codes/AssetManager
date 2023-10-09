<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignedUserRequest;
use App\Http\Resources\AssignedUserResource;
use App\Models\AssignedUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AssignedUserController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return AssignedUserResource::collection(AssignedUser::all());
    }

    public function store(AssignedUserRequest $request): AssignedUserResource
    {
        /** @var array<string, mixed> $requestData */
        $requestData = $request->validated();

        return new AssignedUserResource(AssignedUser::create($requestData));
    }

    public function show(AssignedUser $assignedUser): AssignedUserResource
    {
        return new AssignedUserResource($assignedUser);
    }

    public function update(AssignedUserRequest $request, AssignedUser $assignedUser): AssignedUserResource
    {
        /** @var array<string, mixed> $requestData */
        $requestData = $request->validated();

        $assignedUser->update($requestData);

        return new AssignedUserResource($assignedUser);
    }

    public function destroy(AssignedUser $assignedUser): JsonResponse
    {
        $assignedUser->delete();

        return response()->json();
    }
}
