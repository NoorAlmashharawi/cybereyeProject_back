<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class AIChatController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        try {
            $result = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'أنت مساعد ذكي في لوحة تحكم أكاديمية CyberEye. وظيفتك مساعدة المشرفين بالإجابة على أسئلة حول إحصائيات الطلاب، الكورسات، والتقارير. أجب باللغة العربية الفصحى البسيطة.'],
                    ['role' => 'user', 'content' => $request->message],
                ],
            ]);

            return response()->json([
                'success' => true,
                'message' => $result->choices[0]->message->content
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ: ' . $e->getMessage()
            ], 500);
        }
    }
}