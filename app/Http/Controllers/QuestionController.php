<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Question\AnswerDeleteAction;
use App\Actions\Question\AnswerStoreAction;
use App\Actions\Question\AnswerUpdateAction;
use App\Http\Requests\Question\QuestionStore;
use App\Http\Requests\Question\QuestionUpdate;
use App\Http\Resources\Question\QuestionCollection;
use App\Http\Resources\Question\QuestionResource;
use App\Models\Question;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    public function index(): QuestionCollection
    {
        return new QuestionCollection(Question::all());
    }

    public function store(QuestionStore $request, AnswerStoreAction $action): QuestionResource
    {
        return new QuestionResource($action->handle($request->validated()));
    }

    public function show(Question $question): QuestionResource
    {
        return new QuestionResource($question);
    }

    public function update(QuestionUpdate $request, Question $question, AnswerUpdateAction $action): QuestionResource
    {
        return new QuestionResource($action->handle($request->validated(), $question));
    }

    public function destroy(Question $question, AnswerDeleteAction $action): JsonResponse
    {
        return response()->json(['success' => $action->handle($question)], Response::HTTP_OK);
    }
}
