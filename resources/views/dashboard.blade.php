<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800">
            Sales Management System
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto py-6">

        {{-- CATEGORY LIST BUTTON --}}
        <div class="mb-4 flex justify-end">
            <a href="{{ route('categories.index') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
                Add Category
            </a>
        </div>

        {{-- SUCCESS --}}
        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-5">
            {{ session('success') }}
        </div>
        @endif

        {{-- TABS --}}
        <div class="flex border-b mb-8 text-lg">
            <!-- <button onclick="showTab('category', this)" class="tab-btn active-tab">Category</button> -->
            <button onclick="showTab('product', this)" class="tab-btn">Product</button>
            <button onclick="showTab('list', this)" class="tab-btn">Product List</button>
            <button onclick="showTab('enquiry', this)" class="tab-btn">Enquiries</button>
        </div>

        {{-- CATEGORY --}}
        <div id="category" class="tab-content">
            <div class="bg-white p-10 rounded-lg shadow max-w-4xl mx-auto">

                <h3 class="font-bold mb-6 text-xl text-center">Add Category</h3>

                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf

                    <input type="text" name="name"
                        placeholder="Enter Category Name"
                        class="border p-4 w-full mb-5 rounded text-lg">

                    <button class="bg-blue-600 text-white py-3 rounded w-full text-lg hover:bg-blue-700">
                        Save Category
                    </button>

                </form>
            </div>
        </div>

        {{-- PRODUCT --}}
        <div id="product" class="tab-content hidden">
            <div class="bg-white p-10 rounded-lg shadow max-w-4xl mx-auto">

                <h3 class="font-bold mb-6 text-xl text-center">Add Product</h3>

                <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <select name="category_id"
                        class="border p-4 w-full mb-5 rounded text-lg" required>

                        <option value="" disabled selected>Select Category</option>

                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach

                    </select>

                    <input type="text" name="name"
                        placeholder="Product Name"
                        class="border p-4 w-full mb-5 rounded text-lg">

                    <input type="number" name="price"
                        placeholder="Price"
                        class="border p-4 w-full mb-5 rounded text-lg">

                    <input type="file" name="image"
                        class="border p-3 w-full mb-5 rounded">

                    <button class="bg-blue-600 text-white py-3 rounded w-full text-lg hover:bg-blue-700">
                        Save Product
                    </button>

                </form>
            </div>
        </div>

        {{-- PRODUCT LIST --}}
        <div id="list" class="tab-content hidden">
            <div class="bg-white p-6 rounded shadow">

                <h3 class="font-semibold mb-4 text-lg">Product List</h3>

                <table class="w-full border text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3">#</th>
                            <th class="p-3">Image</th>
                            <th class="p-3">Name</th>
                            <th class="p-3">Category</th>
                            <th class="p-3">Price</th>
                            <th class="p-3">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($products as $key => $p)
                        <tr class="border-t text-center hover:bg-gray-50">

                            <td class="p-3">{{ $key + 1 }}</td>

                            <td class="p-3">
                                @if($p->image)
                                <img src="{{ asset('storage/'.$p->image) }}"
                                    class="w-10 h-10 mx-auto rounded object-cover shadow">
                                @else
                                <span class="text-gray-400 text-xs">No Image</span>
                                @endif
                            </td>

                            <td class="p-3 font-medium">{{ $p->name }}</td>

                            <td class="p-3">{{ $p->category->name ?? '-' }}</td>

                            <td class="p-3 text-blue-600 font-semibold">
                                ₹ {{ $p->price }}
                            </td>

                            {{-- ACTIONS --}}
                            <td class="p-3">
                                <div class="flex justify-center gap-2">

                                    {{-- EDIT --}}
                                    <a href="{{ route('products.edit', $p->id) }}"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                                        Edit
                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('products.destroy', $p->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure to delete this product?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
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

        {{-- ENQUIRY LIST --}}
        <div id="enquiry" class="tab-content hidden">
            <div class="bg-white p-6 rounded shadow">

                <h3 class="font-semibold mb-4 text-lg">Enquiry List</h3>

                <form method="GET" class="flex gap-3 mb-4 items-end">

                    <input type="hidden" name="tab" value="enquiry"> {{-- IMPORTANT --}}

                    <div>
                        <label>From</label>
                        <input type="date" name="from" value="{{ request('from') }}" class="border p-2">
                    </div>

                    <div>
                        <label>To</label>
                        <input type="date" name="to" value="{{ request('to') }}" class="border p-2">
                    </div>

                    <button class="bg-blue-500 text-white px-4 py-2 rounded">
                        Filter
                    </button>

                </form>

                <div class="flex justify-end mb-4">
                    <a href="{{ route('enquiries.pdf', request()->all()) }}"
                        class="bg-red-500 text-white px-4 py-2 rounded">
                        Download PDF
                    </a>
                </div>

                <table class="w-full border text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3">#</th>
                            <th class="p-3">Date</th>
                            <th class="p-3">Product</th>
                            <th class="p-3">Category</th>
                            <th class="p-3">Amount</th>
                            <th class="p-3">Name</th>
                            <th class="p-3">Mobile</th>
                            <th class="p-3">Qty</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Remark</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($enquiries as $key => $e)
                        <tr class="border-t text-center">

                            <td>{{ $key + 1 }}</td>
                            <td>{{ $e->date }}</td>
                            <td>{{ $e->product->name ?? '-' }}</td>
                            <td>{{ $e->category_name }}</td>
                            <td>₹ {{ $e->amount }}</td>
                            <td>{{ $e->name }}</td>
                            <td>{{ $e->mobile }}</td>
                            <td>{{ $e->quantity }}</td>

                            <td>
                                <span class="{{ $e->contacted ? 'text-green-600' : 'text-red-500' }}">
                                    {{ $e->contacted ? 'Contacted' : 'Pending' }}
                                </span>
                            </td>

                            <td>{{ $e->remark ?? '-' }}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>

    {{-- STYLE --}}
    <style>
        .tab-btn {
            padding: 12px 20px;
            margin-right: 10px;
            border-bottom: 2px solid transparent;
            cursor: pointer;
        }

        .active-tab {
            border-bottom: 3px solid #2563eb;
            font-weight: bold;
        }
    </style>

    {{-- SCRIPT --}}
    <!-- <script>
        function showTab(tab, el) {
            document.querySelectorAll('.tab-content').forEach(e => e.classList.add('hidden'));
            document.getElementById(tab).classList.remove('hidden');

            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active-tab'));
            el.classList.add('active-tab');
        }
    </script> -->

    <script>
        function showTab(tab, el = null) {
            document.querySelectorAll('.tab-content').forEach(e => e.classList.add('hidden'));
            document.getElementById(tab).classList.remove('hidden');

            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active-tab'));
            if (el) el.classList.add('active-tab');
        }

        // 🔥 AUTO OPEN TAB AFTER RELOAD
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab') || 'product';

            showTab(tab);

            // highlight tab button
            document.querySelectorAll('.tab-btn').forEach(btn => {
                if (btn.innerText.toLowerCase().includes(tab)) {
                    btn.classList.add('active-tab');
                }
            });
        });
    </script>

</x-app-layout>