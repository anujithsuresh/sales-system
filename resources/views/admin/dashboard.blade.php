<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Dashboard</h2>
    </x-slot>

    <div class="p-6 grid md:grid-cols-3 gap-6">

        <a href="{{ route('categories.create') }}"
            class="bg-blue-500 text-white p-6 rounded-xl text-center">
            Add Category
        </a>

        <a href="{{ route('products.create') }}"
            class="bg-green-500 text-white p-6 rounded-xl text-center">
            Add Product
        </a>

        <a href="{{ route('products.index') }}"
            class="bg-gray-700 text-white p-6 rounded-xl text-center">
            Product List
        </a>

    </div>
</x-app-layout>