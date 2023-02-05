<a href="{{ route('panel.shooting.show', $model) }}" class="btn-secondary btn-sm btn btn-icon">
    <i class="fas fa-eye"></i>
</a>

<a href="{{ route('panel.shooting.edit', $model) }}" class="btn-primary btn-sm btn btn-icon">
    <i class="fas fa-pencil"></i>
</a>

<form action="{{ route('panel.shooting.destroy', $model) }}" method="POST" class="d-inline">
    @csrf
    @method('DELETE')
    <button class="btn-danger btn-sm btn btn-icon" type="submit">
        <i class="fas fa-trash"></i>
    </button>
</form>