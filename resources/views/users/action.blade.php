<a href="{{ route('users.edit', $row->id) }}" class="btn btn-sm btn-primary">Edit</a>
<form action="{{ route('users.destroy', $row->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
</form>
