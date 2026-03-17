<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Category Management
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto py-6">

        {{-- SUCCESS --}}
        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        {{-- ADD CATEGORY --}}
        <div class="bg-white p-6 rounded shadow mb-6 max-w-xl mx-auto">

            <h3 class="font-semibold mb-4 text-lg text-center">
                Add Category
            </h3>

            <form method="POST" action="{{ route('categories.store') }}">
                @csrf

                <input type="text" name="name"
                    placeholder="Enter category name"
                    class="border p-3 w-full mb-3 rounded">

                <button class="bg-blue-600 text-white py-2 rounded w-full">
                    Save Category
                </button>

            </form>
        </div>

        {{-- CATEGORY LIST --}}
        <div class="bg-white p-6 rounded shadow">

            <h3 class="font-semibold mb-4 text-lg">
                Category List
            </h3>

            <table class="w-full border text-sm">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3">#</th>
                        <th class="p-3">Category Name</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($categories as $key => $cat)
                    <tr class="border-t text-center">

                        <td class="p-3">{{ $key + 1 }}</td>

                        <td class="p-3 font-medium">
                            {{ $cat->name }}
                        </td>

                        <td class="p-3">
                            <div class="flex justify-center gap-2">

                                {{-- EDIT --}}
                                <a href="{{ route('categories.edit', $cat->id) }}"
                                    class="bg-yellow-400 text-white px-3 py-1 rounded text-sm">
                                    Edit
                                </a>

                                {{-- DELETE --}}
                                <form action="{{ route('categories.destroy', $cat->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

    </div>
</x-app-layout>