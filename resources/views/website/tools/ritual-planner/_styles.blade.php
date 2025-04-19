<!-- Estilos do Planejador de Rituais -->
<style>
/* Estilos para os elementos */
.elements-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
    gap: 0.5rem;
}

.element-item label {
    width: 100%;
    text-align: center;
    padding: 0.5rem;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
}

.element-btn {
    background: linear-gradient(45deg, var(--bs-primary), var(--bs-primary-dark));
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.element-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.element-item label i {
    display: block;
    font-size: 1.5rem;
    margin-bottom: 0.3rem;
}

/* Estilos para o melhor momento */
.time-display {
    padding: 1rem;
    background: linear-gradient(45deg, rgba(var(--bs-primary-rgb), 0.15), rgba(var(--bs-primary-rgb), 0.1));
    border-radius: 1rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    border: 1px solid rgba(var(--bs-primary-rgb), 0.2);
}

.planetary-info {
    padding: 1rem;
    background: linear-gradient(45deg, rgba(var(--bs-primary-rgb), 0.15), rgba(var(--bs-primary-rgb), 0.1));
    border-radius: 1rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    border: 1px solid rgba(var(--bs-primary-rgb), 0.2);
}

/* Estilos para os materiais recomendados */
.recommended-items {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.recommended-item {
    background: linear-gradient(45deg, rgba(var(--bs-primary-rgb), 0.15), rgba(var(--bs-primary-rgb), 0.1));
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border: 1px solid rgba(var(--bs-primary-rgb), 0.2);
    color: var(--bs-dark);
}

.recommended-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    background: linear-gradient(45deg, rgba(var(--bs-primary-rgb), 0.2), rgba(var(--bs-primary-rgb), 0.15));
}

.recommended-item small {
    color: var(--bs-primary);
    font-weight: 500;
}

/* Estilos para os passos do ritual */
.step-section {
    background: linear-gradient(45deg, rgba(var(--bs-primary-rgb), 0.15), rgba(var(--bs-primary-rgb), 0.1));
    padding: 1.5rem;
    border-radius: 1rem;
    margin-bottom: 1rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    border: 1px solid rgba(var(--bs-primary-rgb), 0.2);
}

.step-title {
    color: var(--bs-primary);
    margin-bottom: 1rem;
    font-weight: 600;
    font-size: 1.1rem;
}

.step-content {
    padding-left: 1.5rem;
}

.step-content li {
    margin-bottom: 0.75rem;
    position: relative;
    padding-left: 1.5rem;
    color: var(--bs-dark);
}

.step-content li:before {
    content: '✅';
    position: absolute;
    left: 0;
    top: 0;
}

/* Responsividade */
@media (max-width: 991.98px) {
    .col-lg-4 {
        margin-bottom: 1.5rem;
    }
}

/* Gradientes e Cores */
.bg-gradient-primary {
    background: linear-gradient(45deg, var(--bs-primary), var(--bs-primary-dark));
}

.btn-primary {
    background: linear-gradient(45deg, var(--bs-primary), var(--bs-primary-dark));
    border: none;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}

/* Cards */
.card {
    background: white;
    border: 1px solid rgba(var(--bs-primary-rgb), 0.1);
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
}

.card-title {
    color: var(--bs-primary);
    font-weight: 600;
}

/* Formulários */
.form-label {
    color: var(--bs-dark);
    font-weight: 500;
}

.form-text {
    color: var(--bs-gray-600);
}

/* Animações */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

#resultContainer {
    animation: fadeIn 0.5s ease-out;
}

/* Alertas */
.alert {
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.alert-success {
    background: linear-gradient(45deg, rgba(var(--bs-success-rgb), 0.1), rgba(var(--bs-success-rgb), 0.05));
    border-left: 4px solid var(--bs-success);
}

.alert-warning {
    background: linear-gradient(45deg, rgba(var(--bs-warning-rgb), 0.1), rgba(var(--bs-warning-rgb), 0.05));
    border-left: 4px solid var(--bs-warning);
}

.alert-info {
    background: linear-gradient(45deg, rgba(var(--bs-info-rgb), 0.1), rgba(var(--bs-info-rgb), 0.05));
    border-left: 4px solid var(--bs-info);
}

/* Estilos para Informações Místicas */
.mystical-info-card {
    background: linear-gradient(45deg, rgba(var(--bs-primary-rgb), 0.15), rgba(var(--bs-primary-rgb), 0.1));
    padding: 1.5rem;
    border-radius: 1rem;
    border: 1px solid rgba(var(--bs-primary-rgb), 0.2);
}

.mystical-info-card h5 {
    color: var(--bs-primary);
    font-weight: 600;
}

.mystical-info-card li {
    color: var(--bs-dark);
    font-size: 0.95rem;
}

.mystical-info-card i {
    color: var(--bs-primary);
    margin-right: 0.5rem;
}

/* Animações do Loading */
@keyframes crystalPulse {
    0% { transform: scale(1) rotate(0deg); opacity: 0.5; }
    50% { transform: scale(1.2) rotate(180deg); opacity: 1; }
    100% { transform: scale(1) rotate(360deg); opacity: 0.5; }
}

.loading-crystal {
    animation: crystalPulse 2s infinite;
}

.best-date {
    background: linear-gradient(45deg, rgba(var(--bs-success-rgb), 0.15), rgba(var(--bs-success-rgb), 0.1));
    border: 1px solid rgba(var(--bs-success-rgb), 0.2);
}

.selected-date {
    background: linear-gradient(45deg, rgba(var(--bs-primary-rgb), 0.15), rgba(var(--bs-primary-rgb), 0.1));
    border: 1px solid rgba(var(--bs-primary-rgb), 0.2);
}

/* Animação para mensagens de loading */
.fade-message {
    animation: fadeInOut 4s infinite;
}

@keyframes fadeInOut {
    0% { opacity: 0; }
    20% { opacity: 1; }
    80% { opacity: 1; }
    100% { opacity: 0; }
}
</style>
