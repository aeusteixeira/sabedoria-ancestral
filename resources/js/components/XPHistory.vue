<template>
    <div class="xp-history">
        <h3>Histórico de XP</h3>

        <div v-if="loading" class="loading">Carregando...</div>

        <div v-else-if="logs.length === 0" class="empty">
            Nenhum histórico encontrado.
        </div>

        <div v-else class="logs">
            <div v-for="log in logs" :key="log.id" class="log-item">
                <div class="log-info">
                    <span class="action">{{ formatAction(log.action) }}</span>
                    <span class="amount">+{{ log.amount }} XP</span>
                </div>
                <span class="date">{{ formatDate(log.created_at) }}</span>
            </div>
        </div>

        <div v-if="hasMorePages" class="load-more">
            <button @click="loadMore" :disabled="loading">Carregar mais</button>
        </div>
    </div>
</template>

<script>
import xpService from "../services/xpService";

export default {
    name: "XPHistory",
    data() {
        return {
            logs: [],
            currentPage: 1,
            hasMorePages: true,
            loading: false,
        };
    },
    created() {
        this.loadLogs();
    },
    methods: {
        async loadLogs() {
            this.loading = true;
            try {
                const response = await xpService.getHistory(this.currentPage);
                this.logs = [...this.logs, ...response.data];
                this.hasMorePages = response.current_page < response.last_page;
            } catch (error) {
                console.error("Erro ao carregar histórico:", error);
            } finally {
                this.loading = false;
            }
        },
        async loadMore() {
            this.currentPage++;
            await this.loadLogs();
        },
        formatAction(action) {
            const actions = {
                create_post: "Criou um post",
                create_service: "Criou um serviço",
                complete_service: "Completou um serviço",
                daily_login: "Login diário",
                profile_completion: "Completou o perfil",
                first_service: "Primeiro serviço",
                first_post: "Primeiro post",
                follow_user: "Seguiu um usuário",
                get_followed: "Ganhou um seguidor",
                comment_post: "Comentou em um post",
                like_post: "Curtiu um post",
                share_post: "Compartilhou um post",
                create_ritual: "Criou um ritual",
                complete_ritual: "Completou um ritual",
                create_course: "Criou um curso",
                complete_course: "Completou um curso",
            };
            return actions[action] || action;
        },
        formatDate(date) {
            return new Date(date).toLocaleDateString("pt-BR", {
                day: "2-digit",
                month: "2-digit",
                year: "numeric",
                hour: "2-digit",
                minute: "2-digit",
            });
        },
    },
};
</script>

<style scoped>
.xp-history {
    width: 100%;
}

.loading,
.empty {
    text-align: center;
    padding: 2rem;
    color: #666;
}

.logs {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.log-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem;
    background-color: #f8f9fa;
    border-radius: 4px;
}

.log-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.action {
    color: #333;
}

.amount {
    color: #4caf50;
    font-weight: bold;
}

.date {
    color: #666;
    font-size: 0.9rem;
}

.load-more {
    text-align: center;
    margin-top: 1rem;
}

button {
    padding: 0.5rem 1rem;
    background-color: #4caf50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}
</style>
