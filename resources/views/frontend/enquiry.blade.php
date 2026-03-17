<form method="POST" action="{{ route('enquiry.store') }}">
    @csrf

    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="category_name" value="{{ $product->category->name }}">
    <input type="hidden" name="amount" value="{{ $product->price }}">

    <input name="name" placeholder="Name" required>
    <textarea name="address" placeholder="Address"></textarea>
    <input name="quantity" type="number">
    <input name="mobile" placeholder="Mobile">

    <button>Submit</button>
</form>