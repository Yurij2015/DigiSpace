<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GenerationAttempt;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NetPostPanelWebhookController extends Controller
{
    /**
     * Handle NetPostPanel async completion callback.
     *
     * Payload: { request_id, status, result, error }
     */
    public function __invoke(Request $request): JsonResponse
    {
        $requestId = $request->input('request_id');

        if (! is_string($requestId) || $requestId === '') {
            return response()->json(['error' => 'request_id is required'], 422);
        }

        $attempt = GenerationAttempt::where('request_id', $requestId)->first();

        if (! $attempt) {
            return response()->json(['error' => 'Unknown request_id'], 404);
        }

        $status = $request->input('status');
        $result = $request->input('result');
        $error = $request->input('error');

        if ($status === 'failed') {
            Log::warning('NetPostPanel generation failed', [
                'request_id' => $requestId,
                'error' => $error,
            ]);
        }

        $attempt->update([
            'status' => is_string($status) ? $status : $attempt->status,
            'generated_payload' => is_array($result) ? $result : $attempt->generated_payload,
        ]);

        return response()->json(['ok' => true]);
    }
}
