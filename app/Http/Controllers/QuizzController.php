<?php

namespace App\Http\Controllers;

use App\Models\Quizz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;
use Symfony\Component\HttpFoundation\Session\Session;

class QuizzController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $quizzes = Quizz::latest()->paginate(10);
    return view('cms.quizz.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

         return view('cms.quizz.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
               $request->validate([
           'title' => 'required|string|max:255',
           'description' => 'nullable|string',
           'duration_minutes' => 'nullable|integer|min:1',
           'total_marks' => 'nullable|string',
           'course_id' => 'required|exists:courses,id',
       ]);

       Quizz::create($request->all());
       return redirect()->route('quizzs.index')->with('success', 'تم إنشاء الكويز بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show($quizzId)
    {

        $quiz = Quizz::with('questions')->findOrFail($quizzId);
        $questions = $quiz->questions;
        $tempAnswers = FacadesSession::get("quiz_{$quizzId}_temp_answers", []);

        return view('cms.quizz.start', compact('quiz', 'questions', 'tempAnswers'));

    }


    // تقديم الكويز وحساب النتيجة بدون تخزين
    public function submit(Request $request, $quizzId)
    {
        $quiz = Quizz::with('questions')->findOrFail($quizzId);
        $questions = $quiz->questions;

        $submittedAnswers = $request->input('answers', []);
        $totalPoints = 0;
        $earnedPoints = 0;
        $results = [];

        foreach ($questions as $question) {
            $totalPoints += $question->points;
            $userAnswer = $submittedAnswers[$question->id] ?? null;
            $isCorrect = ($userAnswer === $question->correct_answer);
            if ($isCorrect) {
                $earnedPoints += $question->points;
            }
            $results[] = [
                'question' => $question,
                'user_answer' => $userAnswer,
                'is_correct' => $isCorrect,
                'correct_answer' => $question->correct_answer,
            ];
        }

    }


    // حفظ الإجابات مؤقتاً عبر AJAX (اختياري لتحسين التجربة)
    public function saveTemp(Request $request, $quizzId)
    {
       // Session::put("quiz_{$quizzId}_temp_answers", $request->input('answers', []));
       // return response()->json(['status' => 'saved']);
    }




        // تخزين المحاولة
//        $attempt = QuizAttempt::create([
  //          'quizz_id' => $quiz->id,
    //        'student_name' => $request->input('student_name', 'Guest'),
     //       'answers' => $submittedAnswers,
      //      'score' => $earnedPoints,
       //     'total_points' => $totalPoints,
       //     'submitted_at' => now(),
      //  ]);

      //  Session::forget("quiz_{$quizzId}_temp_answers");
      //  Session::flash('quiz_result', [
      //      'score' => $earnedPoints,
      //      'total' => $totalPoints,
      //      'total_marks' => $quiz->total_marks, // من جدول quizzs
      //  ]);

      //  return redirect()->route('quiz.result', $quizzId);
   // }

    // عرض النتيجة
   // public function result($quizzId)
   // {
     //   $quiz = Quizz::findOrFail($quizzId);
      //  $result = ContractsSession::get('quiz_result');
      //  if (!$result) {
        //    return redirect()->route('quiz.show', $quizzId)->with('error', 'لم يتم العثور على نتيجة.');
       // }
      //  return view('result', compact('quiz', 'result'));
   // }

    // حفظ مؤقت (Ajax)
   // public function saveTemp(Request $request, $quizzId)
   // {
    //    Session::put("quiz_{$quizzId}_temp_answers", $request->input('answers', []));
     //   return response()->json(['status' => 'saved']);
   // }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quizz $quizz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quizz $quizz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quizz $quizz)
    {

    $quizz->delete();
    if (request()->ajax()) {
        return response()->json(['success' => true]);
    }
    return redirect()->route('quizzs.index')->with('success', 'تم حذف الكويز بنجاح');
    }
}
