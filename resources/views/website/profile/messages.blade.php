@extends('layouts.web')

@section('content')
<div class="py-4 container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="pb-0 card-header">
                    <h6>Mensagens</h6>
                </div>
                <div class="p-0 card-body">
                    <div class="row g-0" style="height: 600px;">
                        <!-- Lista de Conversas -->
                        <div class="col-md-4 border-end">
                            <div class="p-3 border-bottom">
                                <h6 class="mb-0">Conversas</h6>
                            </div>
                            <div class="conversations-list" style="height: calc(100% - 60px); overflow-y: auto;">
                                @foreach($conversations as $conversation)
                                <a href="/profile/messages?conversation={{ $conversation->id }}"
                                   class="conversation-item p-3 border-bottom d-block text-decoration-none {{ $conversation->id === $selectedConversation?->id ? 'bg-light' : '' }}">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3">
                                            <img src="{{ $conversation->avatar }}" alt="{{ $conversation->name }}" class="rounded-circle">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0 text-dark">{{ $conversation->name }}</h6>
                                            <small class="text-muted">{{ Str::limit($conversation->last_message, 30) }}</small>
                                        </div>
                                        <div class="text-end">
                                            <small class="text-muted">{{ $conversation->last_message_time }}</small>
                                            @if($conversation->unread_count > 0)
                                            <span class="badge bg-primary rounded-circle">{{ $conversation->unread_count }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Área de Chat -->
                        <div class="col-md-8">
                            @if($selectedConversation)
                            <div class="d-flex flex-column h-100">
                                <!-- Cabeçalho do Chat -->
                                <div class="p-3 border-bottom">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-3">
                                            <img src="{{ $selectedConversation->avatar }}" alt="{{ $selectedConversation->name }}" class="rounded-circle">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $selectedConversation->name }}</h6>
                                            <small class="text-muted">{{ $selectedConversation->is_online ? 'Online' : 'Offline' }}</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Mensagens -->
                                <div class="p-3 flex-grow-1" id="messages-container" style="overflow-y: auto;">
                                    @foreach($selectedConversation->messages as $message)
                                    <div class="message {{ $message->sender_id === auth()->id() ? 'message-sent' : 'message-received' }} mb-3">
                                        <div class="message-content p-2 rounded {{ $message->sender_id === auth()->id() ? 'bg-primary text-white' : 'bg-light' }}">
                                            {{ $message->content }}
                                        </div>
                                        <small class="text-muted">{{ $message->created_at->format('H:i') }}</small>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Input de Mensagem -->
                                <div class="p-3 border-top">
                                    <form id="message-form" onsubmit="sendMessage(event, '{{ $selectedConversation->id ?? '' }}')">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="message-input" placeholder="Digite sua mensagem...">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-paper-plane"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @else
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <div class="text-center">
                                    <i class="mb-3 fas fa-comments fa-3x text-muted"></i>
                                    <h6 class="text-muted">Selecione uma conversa para começar</h6>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.conversation-item {
    transition: background-color 0.2s;
    cursor: pointer;
    color: inherit;
}

.conversation-item:hover {
    background-color: #f8f9fa;
    color: inherit;
}

.message {
    max-width: 70%;
}

.message-sent {
    margin-left: auto;
}

.message-received {
    margin-right: auto;
}

.message-content {
    word-wrap: break-word;
}

#messages-container {
    scrollbar-width: thin;
    scrollbar-color: #888 #f1f1f1;
}

#messages-container::-webkit-scrollbar {
    width: 6px;
}

#messages-container::-webkit-scrollbar-track {
    background: #f1f1f1;
}

#messages-container::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

#messages-container::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>

@push('scripts')
<script>
function sendMessage(event, conversationId) {
    event.preventDefault();
    const input = document.getElementById('message-input');
    const content = input.value.trim();

    if (!content) return;

    fetch(`/profile/messages/${conversationId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ content })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            input.value = '';
            // Recarrega a página para mostrar a nova mensagem
            window.location.reload();
        } else {
            alert('Erro ao enviar mensagem');
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert('Erro ao enviar mensagem');
    });
}

// Rola para o final das mensagens quando a página carrega
document.addEventListener('DOMContentLoaded', function() {
    const messagesContainer = document.getElementById('messages-container');
    if (messagesContainer) {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
});
</script>
@endpush
@endsection
