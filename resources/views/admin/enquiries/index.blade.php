<form>
    <input type="date" name="from">
    <input type="date" name="to">
    <button>Filter</button>
</form>

@foreach($enquiries as $e)
<p>{{ $e->name }} - {{ $e->mobile }}</p>

<form method="POST" action="/admin/enquiries/{{ $e->id }}">
    @csrf
    @method('PUT')

    <select name="contacted">
        <option value="1">Contacted</option>
        <option value="0">Not</option>
    </select>

    <input name="remark" placeholder="Remark">

    <button>Update</button>
</form>

@endforeach