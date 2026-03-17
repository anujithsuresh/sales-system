<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Add Product</h2>
    </x-slot>

    <div class="p-6 max-w-xl mx-auto">

        <div class="bg-white p-6 shadow rounded-xl">

            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf

                <select name="category_id" class="border p-3 w-full mb-3 rounded">
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>

                <input name="name" placeholder="Product Name"
                    class="border p-3 w-full mb-3 rounded">

                <input name="price" placeholder="Price"
                    class="border p-3 w-full mb-3 rounded">

                <input type="file" name="image"
                    class="border p-2 w-full mb-3 rounded">

                <button class="bg-green-500 text-white px-4 py-2 rounded">
                    Save Product
                </button>

            </form>

        </div>

    </div>
</x-app-layout>