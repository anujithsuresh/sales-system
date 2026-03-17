<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Add Category</h2>
    </x-slot>

    <div class="p-6 max-w-xl mx-auto">

        <div class="bg-white p-6 shadow rounded-xl">

            <form method="POST" action="{{ route('categories.store') }}">
                @csrf

                <input name="name" placeholder="Category Name"
                    class="border p-3 w-full mb-3 rounded">

                <button class="bg-blue-500 text-white px-4 py-2 rounded">
                    Save Category
                </button>
            </form>

        </div>

    </div>
</x-app-layout>