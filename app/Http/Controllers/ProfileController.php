<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $badges = Badge::all();

        $seo = $this->generateSeo(
            $user->name,
            'Conheça mais sobre ' . $user->name . ', suas contribuições e atividades na plataforma Sabedoria Ancestral.',
            [$user->username],
            'website.profile.index',
            $user->username
        );

        return view('website.profile.index', [
            'user' => $user,
            'badges' => $badges,
            'seo' => $seo
        ]);
    }

    public function edit($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('website.profile.edit', ['user' => $user]);
    }

    public function update(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        // Validação dos dados
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'description' => 'nullable|string|max:1000',
        ]);

        // Atualiza o usuário
        $user->update($validated);

        return redirect()
            ->route('website.profile.index', $user->username)
            ->with('success', 'Perfil atualizado com sucesso!');
    }

    public function settings($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('website.profile.settings', ['user' => $user]);
    }

    public function follow($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $follower = auth()->user();

        if ($follower->id === $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Você não pode seguir a si mesmo.'
            ], 400);
        }

        if ($follower->follow($user)) {
            return response()->json([
                'success' => true,
                'message' => 'Você começou a seguir ' . $user->name,
                'followers_count' => $user->followers()->count()
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Você já está seguindo este usuário.'
        ], 400);
    }

    public function unfollow($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $follower = auth()->user();

        if ($follower->unfollow($user)) {
            return response()->json([
                'success' => true,
                'message' => 'Você deixou de seguir ' . $user->name,
                'followers_count' => $user->followers()->count()
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Você não está seguindo este usuário.'
        ], 400);
    }

    public function sendMessage(Request $request, $conversationId)
    {
        $user = Auth::user();
        $conversations = $user->conversations();
        $conversation = $conversations->first(function ($conv) use ($conversationId) {
            return $conv->id === $conversationId;
        });

        if (!$conversation) {
            return response()->json([
                'success' => false,
                'message' => 'Conversa não encontrada.'
            ], 404);
        }

        $validated = $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $message = $user->sendMessage(User::find($conversationId), $validated['content']);

        return response()->json([
            'success' => true,
            'message' => 'Mensagem enviada com sucesso!',
            'data' => [
                'id' => $message->id,
                'content' => $message->content,
                'created_at' => $message->created_at->diffForHumans()
            ]
        ]);
    }

    public function messages()
    {
        $user = Auth::user();
        $conversations = $user->conversations();
        $selectedConversationId = request('conversation');
        $selectedConversation = null;

        if ($selectedConversationId) {
            $selectedConversation = $conversations->first(function ($conversation) use ($selectedConversationId) {
                return $conversation->id === $selectedConversationId;
            });

            if ($selectedConversation) {
                // Marca as mensagens como lidas
                $selectedConversation->markMessagesAsRead();
            }
        }

        return view('website.profile.messages', [
            'user' => $user,
            'conversations' => $conversations,
            'selectedConversation' => $selectedConversation
        ]);
    }
}
