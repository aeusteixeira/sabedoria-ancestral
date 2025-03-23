import axios from "axios";

export default {
    /**
     * Adiciona XP por uma ação específica
     */
    async addXP(action) {
        try {
            const response = await axios.post("/xp/add", { action });
            return response.data;
        } catch (error) {
            console.error("Erro ao adicionar XP:", error);
            throw error;
        }
    },

    /**
     * Obtém o histórico de XP do usuário
     */
    async getHistory(page = 1) {
        try {
            const response = await axios.get(`/xp/history?page=${page}`);
            return response.data;
        } catch (error) {
            console.error("Erro ao obter histórico de XP:", error);
            throw error;
        }
    },
};
