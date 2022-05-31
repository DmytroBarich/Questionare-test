<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Answer\AnswerDeleteAction;
use App\Http\Requests\Answer\AnswerStore;
use App\Http\Resources\Answer\AnswerCollection;
use App\Http\Resources\Answer\AnswerResource;
use App\Models\Answer;
use App\Services\AnswerService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AnswerController extends Controller
{
    public function index(): AnswerCollection
    {
        return new AnswerCollection(Answer::query()->paginate());
    }

    public function store(AnswerStore $request, AnswerService $service): AnswerResource
    {
        return new AnswerResource($service->storeAnswer($request->validated()));
    }

    public function show(Answer $answer): AnswerResource
    {
        return new AnswerResource($answer);
    }

    public function destroy(Answer $answer, AnswerDeleteAction $action): JsonResponse
    {
        return response()->json(['success' => $action->handle($answer)], Response::HTTP_OK);
    }
}
