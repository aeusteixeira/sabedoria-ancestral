<?php

namespace App\Http\Controllers;

use App\Services\XPService;
use Illuminate\Http\Request;

class XPController extends Controller
{
    protected $xpService;

    public function __construct(XPService $xpService)
    {
        $this->xpService = $xpService;
    }

    /**
     * Adiciona XP por uma ação específica
     */
    public function addXP(Request $request)
    {
        $user = $request->user();
        $action = $request->input('action');

        if (!$this->xpService->hasReceivedXPToday($user, $action)) {
            $this->xpService->rewardXP($user, $action);
            $this->xpService->logXPAction($user, $action, 5);

            return response()->json([
                'success' => true,
                'message' => 'XP adicionado com sucesso!',
                'xp' => $user->xp,
                'level' => $user->level,
                'next_level_xp' => $user->next_level_xp,
                'progress' => $user->getLevelProgress(),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Você já recebeu XP por esta ação hoje.',
        ]);
    }

    /**
     * Retorna o histórico de XP do usuário
     */
    public function getHistory(Request $request)
    {
        $user = $request->user();
        $logs = $user->xp_logs()
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json($logs);
    }
}
