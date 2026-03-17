<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Product List</h2>
    </x-slot>

    <div class="p-6 max-w-6xl mx-auto">

        <div class="bg-white p-6 shadow rounded-xl">

            <table class="w-full">
                <tr class="bg-gray-100">
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                </tr>

                @foreach($products as $key => $p)
                <tr class="border-t text-center">
                    <td>{{ $key+1 }}</td>

                    <td>
                        @if($p->image)
                        <img src="{{ asset('storage/'.$p->image) }}" class="w-10 h-10 mx-auto">
                        @endif
                    </td>

                    <td>{{ $p->name }}</td>
                    <td>{{ $p->category->name }}</td>
                    <td>₹ {{ $p->price }}</td>
                </tr>
                @endforeach

            </table>

        </div>

    </div>
</x-app-layout>