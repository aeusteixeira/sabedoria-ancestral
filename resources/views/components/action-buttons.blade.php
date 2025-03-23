<div class="gap-2 d-flex">
    @if($showEdit && $editRoute)
        <a href="{{ route($editRoute, ['id' => $itemId]) }}" class="btn btn-sm btn-secondary">
            <i class="fa fa-pencil"></i> Editar
        </a>
    @endif

    @if($showDelete && $deleteRoute)
        <button class="btn btn-sm btn-danger" onclick="confirmDelete({{ $itemId }})">
            <i class="fa fa-trash"></i> Excluir
        </button>
    @endif
</div>

<script>
    function confirmDelete(id) {
        if (confirm("Tem certeza que deseja excluir este item? Essa ação não pode ser desfeita!")) {
            document.getElementById(`delete-form-${id}`).submit();
        }
    }
</script>

@foreach([$itemId] as $id)
<form id="delete-form-{{ $id }}" action="{{ route($deleteRoute, ['id' => $id]) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endforeach
