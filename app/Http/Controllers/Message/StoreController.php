<?php

namespace App\Http\Controllers\Message;

use App\Http\Controllers\Controller;
use App\Http\Requests\Message\StoreRequest;
use App\Http\Resources\Message\MessageResource;
use App\Models\Message;
use App\Models\MessageStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();
            $message = Message::create([
                'chat_id' => $data['chat_id'],
                'user_id' => auth()->id(),
                'body' => $data['body'],
            ]);

            $data['user_ids[]'] = array_filter($data['user_ids[]'], function ($id) {
                return (int)$id !== auth()->id();
            });

            foreach ($data['user_ids[]'] as $user_id) {
                MessageStatus::create([
                    'message_id' => $message->id,
                    'chat_id' => $message->chat_id,
                    'user_id' => $user_id,
                    'is_read' => false,
                ]);
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message', $e->getMessage()]);
        }

        return MessageResource::make($message)->resolve();
    }
}
