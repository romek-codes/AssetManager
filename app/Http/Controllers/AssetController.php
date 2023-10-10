<?php

namespace App\Http\Controllers;

use App\Data\AssetData;
use App\Http\Requests\AssetRequest;
use App\Http\Resources\AssetResource;
use App\Models\Asset;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;

class AssetController extends Controller
{
    public function index(): Response
    {
        //        $assets = ['assets' => Asset::with('image', 'category', 'assignedUser')->all()];

        return Inertia::render('Dashboard', ['assets' => AssetData::from(Asset::with('image', 'category', 'assignedUser')->get())]);
    }

    public function store(AssetRequest $request): AssetResource
    {
        /** @var array<string, mixed> $requestData */
        $requestData = $request->validated();

        return new AssetResource(Asset::create($requestData));
    }

    public function show(Asset $asset): AssetResource
    {
        return new AssetResource($asset);
    }

    public function update(AssetRequest $request, Asset $asset): AssetResource
    {
        /** @var array<string, mixed> $requestData */
        $requestData = $request->validated();

        $asset->update($requestData);

        return new AssetResource($asset);
    }

    public function destroy(Asset $asset): JsonResponse
    {
        $asset->delete();

        return response()->json();
    }
}
