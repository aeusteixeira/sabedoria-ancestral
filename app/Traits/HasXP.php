<?php

namespace App\Traits;

trait HasXP
{
    /**
     * Adiciona XP ao usuário
     */
    public function addXP(int $amount): void
    {
        $this->xp += $amount;
        $this->checkLevelUp();
        $this->save();
    }

    /**
     * Verifica se o usuário subiu de nível
     */
    protected function checkLevelUp(): void
    {
        while ($this->xp >= $this->next_level_xp) {
            $this->levelUp();
        }
    }

    /**
     * Faz o usuário subir de nível
     */
    protected function levelUp(): void
    {
        $this->level++;
        $this->xp -= $this->next_level_xp;
        $this->next_level_xp = $this->calculateNextLevelXP();
    }

    /**
     * Calcula o XP necessário para o próximo nível
     */
    protected function calculateNextLevelXP(): int
    {
        // Fórmula: XP base * (nível ^ 1.5)
        return (int) (100 * pow($this->level, 1.5));
    }

    /**
     * Retorna o progresso para o próximo nível (0-100)
     */
    public function getLevelProgress(): int
    {
        return (int) (($this->xp / $this->next_level_xp) * 100);
    }

    /**
     * Retorna o XP restante para o próximo nível
     */
    public function getRemainingXP(): int
    {
        return $this->next_level_xp - $this->xp;
    }
}
