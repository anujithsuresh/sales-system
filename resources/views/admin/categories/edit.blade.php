<x-app-layout>
    <div class="max-w-xl mx-auto py-6">

        <h2 class="text-xl font-bold mb-4">Edit Category</h2>

        <form method="POST" action="{{ route('categories.update', $category->id) }}">
            @csrf
            @method('PUT')

            <input type="text" name="name"
                value="{{ $category->name }}"
                class="border p-3 w-full mb-3 rounded">

            <button class="bg-blue-600 text-white px-4 py-2 rounded w-full">
                Update
            </button>

        </form>

    </div>
</x-app-layout>