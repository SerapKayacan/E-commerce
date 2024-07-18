@forelse ($products as $product)
    <li>{{ $product->name }} {{ $product->created_at }}</li>
@empty
    <p>No product</p>
@endforelse
