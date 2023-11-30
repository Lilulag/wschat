<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\StoreRequest;
use App\Http\Resources\Chat\ChatResource;
use App\Http\Resources\Chat\ChatShortResource;
use App\Http\Resources\Message\MessageResource;
use App\Http\Resources\User\UserResource;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = UserResource::collection(User::query()
            ->whereNot('id', auth()->id())
            ->get())
            ->resolve();

        $chats = ChatShortResource::collection(auth()->user()->chats()->get())->resolve();

        return inertia('Chat/Index', compact('users', 'chats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $arrayIds = array_values($data['users']);
        sort($arrayIds);
        $stringIds = implode('-', $arrayIds);

        try {
            DB::beginTransaction();

            $chat = Chat::firstOrCreate([
                'users' => $stringIds,
            ],
                [
                    'title' => $data['title'],
                ]);

            $chat->users()->sync($arrayIds);

            DB::commit();

            return redirect()->route('chats.show', compact('chat'));
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        $messages = MessageResource::collection($chat->messages()->get())->resolve();
        $chat = ChatResource::make($chat)->resolve();

        return inertia('Chat/Show', compact('chat', 'messages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
