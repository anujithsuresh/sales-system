<!DOCTYPE html>
<html>

<head>
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">

        <h2 class="mb-4">Products</h2>

        <div class="row">

            @foreach($products as $product)
            <div class="col-md-4 mb-4">

                <div class="card p-3">

                    {{-- IMAGE --}}
                    @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}"
                        class="w-100 mb-2" style="height:150px;object-fit:cover;">
                    @endif

                    <h5>{{ $product->name }}</h5>
                    <p>₹ {{ $product->price }}</p>

                    {{-- 🔵 ENQUIRY BUTTON --}}
                    <a href="{{ route('enquiry.form', $product->id) }}"
                        class="btn btn-primary btn-sm">
                        Enquiry
                    </a>

                </div>

            </div>
            @endforeach

        </div>

    </div>

</body>

</html>