<?php

namespace App\Http\Controllers;

use App\Models\Question;

use Illuminate\Http\Request;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $questions = Question::latest()->paginate(10);
        return view('cms.question.index', compact('questions'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('cms.question.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           $request->validate([
             'quizz_id' => 'required|exists:quizzs,id',
            'title' => 'required|string',
            'type' => 'required|in:mc,tf',
            'options' => 'required_if:type,mc|array|min:2',
            'options.*' => 'string|distinct',
            'correct_answer' => 'required|string',
            'points' => 'required|integer|min:1',
        ]);

        Question::create([
            'quizz_id' => $request->quizz_id,
            'title' => $request->title,
            'type' => $request->type,
            'options' => $request->type == 'mc' ? json_encode($request->options) : null,
            'correct_answer' => $request->correct_answer,
            'points' => $request->points,
        ]);

        return redirect()->route('questions.index')->with('success', 'تم إضافة السؤال بنجاح');


    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
         return view('cms.question.edit', compact('question'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {

        $request->validate([
            'title' => 'required|string',
            'type' => 'required|in:mc,tf',
            'options' => 'required_if:type,mc|array|min:2',
            'options.*' => 'string|distinct',
            'correct_answer' => 'required|string',
            'points' => 'integer|min:1',
        ]);

        $data = $request->except('options');
        if ($request->type === 'mc') {
            $data['options'] = json_encode($request->options);
        } else {
            $data['options'] = null;
        }

        $question->update($data);
        return redirect()->route('questions.index')->with('success', 'تم تحديث السؤال بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {


        $question->delete();
    if (request()->ajax()) {
        return response()->json(['success' => true]);
    }
    return redirect()->route('questions.index')->with('success', 'تم حذف السؤال بنجاح');
    }
}
