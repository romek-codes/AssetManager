<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ImageController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return ImageResource::collection(Image::all());
    }

    public function store(ImageRequest $request): ImageResource
    {
        /** @var array<string, mixed> $requestData */
        $requestData = $request->validated();

        return new ImageResource(Image::create($requestData));
    }

    public function show(Image $image): ImageResource
    {
        return new ImageResource($image);
    }

    public function update(ImageRequest $request, Image $image): ImageResource
    {
        /** @var array<string, mixed> $requestData */
        $requestData = $request->validated();

        $image->update($requestData);

        return new ImageResource($image);
    }

    public function destroy(Image $image): JsonResponse
    {
        $image->delete();

        return response()->json();
    }
}
