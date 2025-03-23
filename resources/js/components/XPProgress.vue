<template>
    <div class="xp-progress">
        <div class="level-info">
            <span class="level">Nível {{ user.level }}</span>
            <span class="xp">{{ user.xp }} / {{ user.next_level_xp }} XP</span>
        </div>
        <div class="progress-bar">
            <div class="progress" :style="{ width: `${progress}%` }"></div>
        </div>
    </div>
</template>

<script>
export default {
    name: "XPProgress",
    props: {
        user: {
            type: Object,
            required: true,
        },
    },
    computed: {
        progress() {
            return (this.user.xp / this.user.next_level_xp) * 100;
        },
    },
};
</script>

<style scoped>
.xp-progress {
    width: 100%;
}

.level-info {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    color: #666;
}

.progress-bar {
    width: 100%;
    height: 8px;
    background-color: #eee;
    border-radius: 4px;
    overflow: hidden;
}

.progress {
    height: 100%;
    background: linear-gradient(90deg, #4caf50, #8bc34a);
    transition: width 0.3s ease;
}
</style>
