<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/api/generate-roadmap', function (Request $request) {
    $level = $request->input('level');
    $goal = $request->input('goal');
    $time = $request->input('time');
    $describesYou = implode(', ', $request->input('describes_you', []));
    $motivatesYou = implode(', ', $request->input('motivates_you', []));
    $experience = $request->input('experience');
    $investmentBudget = $request->input('investment_budget');
    $lang = $request->input('lang', 'en');

    $prompt = "Act as a Senior Crypto & Web3 Educator. Create a highly personalized, professional, and detailed learning roadmap for a user with the following profile:\n    - Knowledge Level: $level\n    - Primary Goal: $goal\n    - Daily Time Commitment: $time\n    - What describes you best: $describesYou\n    - What motivates you: $motivatesYou\n    - Experience: $experience\n    - Investment Budget: $investmentBudget\n    - Language: $lang\n    \n    The response MUST be in HTML format (using basic tags like <h3>, <p>, <ul>, <li>). \n    Include:\n    1. A clear Roadmap title.\n    2. Step-by-step milestones (at least 5 steps).\n    3. Recommended high-quality resources (websites, books, or courses).\n    4. Pro tips for success in the $goal field.\n    \n    IMPORTANT: The entire response MUST be written in the specified language ($lang). If the language is Persian (fa) or Arabic (ar), ensure the tone is professional and natural.";

    $baseUrl = env('AI_BASE_URL');
    $token = env('AI_TOKEN');
    $model = env('AI_MODEL');

    try {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/json',
        ])->post($baseUrl, [
            'model' => $model,
            'messages' => [
                ['role' => 'user', 'content' => $prompt]
            ],
            'temperature' => 0.7,
            'max_tokens' => 2048,
            'stream' => false,
        ]);

        if ($response->successful()) {
            $aiResult = $response->json()['choices'][0]['message']['content'];
            
            // Clean up AI response if it contains markdown code blocks
            $aiResult = preg_replace('/```html|```/', '', $aiResult);

            // Save history to file
            $historyEntry = [
                'timestamp' => now()->toIso8601String(),
                'input' => [
                    'level' => $level,
                    'goal' => $goal,
                    'time' => $time,
                    'describes_you' => $describesYou,
                    'motivates_you' => $motivatesYou,
                    'experience' => $experience,
                    'investment_budget' => $investmentBudget,
                    'lang' => $lang
                ],
                'output' => $aiResult
            ];
            
            $filename = 'history_' . date('Y-m-d') . '.jsonl';
            Storage::disk('local')->append($filename, json_encode($historyEntry));

            return response()->json(['roadmap' => $aiResult]);
        }

        return response()->json(['error' => 'AI Service failed'], 500);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

Route::get('/api/history', function () {
    $filename = 'history_' . date('Y-m-d') . '.jsonl';
    if (!Storage::disk('local')->exists($filename)) {
        return response()->json(['history' => []]);
    }

    $content = Storage::disk('local')->get($filename);
    $lines = explode("\n", trim($content));
    $history = array_map(function($line) {
        return json_decode($line, true);
    }, array_reverse($lines));

    return response()->json(['history' => array_slice($history, 0, 5)]);
});
