<x-app-layout>
    <div class="max-w-xl mx-auto py-6">

        <h2 class="text-xl font-bold mb-4">Edit Product</h2>

        <form method="POST" action="{{ route('products.update', $product->id) }}">
            @csrf
            @method('PUT')

            <select name="category_id" class="border p-3 w-full mb-3">
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                    {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
                @endforeach
            </select>

            <input type="text" name="name"
                value="{{ $product->name }}"
                class="border p-3 w-full mb-3">

            <input type="number" name="price"
                value="{{ $product->price }}"
                class="border p-3 w-full mb-3">

            <button class="bg-blue-600 text-white px-4 py-2 rounded w-full">
                Update
            </button>

        </form>

    </div>
</x-app-layout>