<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quizz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('quizz')->latest()->paginate(10);
        return view('cms.question.index', compact('questions'));
    }

    public function create()
    {
        $quizzes = Quizz::with('course')->get();
        return view('cms.question.create', compact('quizzes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quizz_id' => 'required|exists:quizzs,id',
            'title' => 'required|string',
            'options' => 'required|array|min:2',
            'options.*' => 'string|distinct',
            'correct_answer' => 'required|string',
            'points' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->errors()->first(),
            ], 400);
        }

        try {
            DB::beginTransaction();

            $question = Question::create([
                'quizz_id' => $request->quizz_id,
                'title' => $request->title,
                'type' => 'mc',
                'options' => json_encode($request->options),
                'correct_answer' => $request->correct_answer,
                'points' => $request->points,
            ]);

            DB::commit();

            return response()->json([
                'icon' => 'success',
                'title' => 'تم إنشاء السؤال بنجاح'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'icon' => 'error',
                'title' => 'خطأ: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
         $question = Question::findOrFail($id);
    $quizzes = Quizz::with('course')->get();
    return view('cms.question.edit', compact('question', 'quizzes'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quizz_id' => 'required|exists:quizzs,id',
            'title' => 'required|string',
            'options' => 'required|array|min:2',
            'options.*' => 'string|distinct',
            'correct_answer' => 'required|string',
            'points' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'icon' => 'error',
                'title' => $validator->errors()->first(),
            ], 400);
        }

        try {
            $question = Question::findOrFail($id);
            $question->update([
                'quizz_id' => $request->quizz_id,
                'title' => $request->title,
                'options' => json_encode($request->options),
                'correct_answer' => $request->correct_answer,
                'points' => $request->points,
            ]);

            return response()->json([
                'icon' => 'success',
                'title' => 'تم تحديث السؤال بنجاح'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'icon' => 'error',
                'title' => 'خطأ: ' . $e->getMessage()
            ], 500);
        }
    }


////////////////////
 public function trashed()
{
    $questions = Question::onlyTrashed()->with('quizz')->get();
    return view('cms.question.trashed', compact('questions'));
}

 public function restore($id)
{
    $question = Question::onlyTrashed()->findOrFail($id);
    $question->restore();

    return response()->json([
        'success' => true,
        'message' => 'تم استعادة السؤال بنجاح'
    ]);
}
 public function forceDelete($id)
{
    $question = Question::onlyTrashed()->findOrFail($id);
    $question->forceDelete();

    return response()->json([
        'success' => true,
        'message' => 'تم حذف السؤال نهائياً'
    ]);
}

public function destroy($id)
{
    $question = Question::find($id);
    if (!$question) {
        return response()->json(['success' => false, 'message' => 'السؤال غير موجود'], 404);
    }
    $question->delete();
    return response()->json(['success' => true, 'message' => 'تم نقل السؤال إلى الأرشيف']);
}


}
