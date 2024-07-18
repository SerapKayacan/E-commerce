@forelse ($categories as $category)
    <li>{{ $category->name }} {{ $category->created_at }}</li>
@empty
    <p>No categories</p>
@endforelse
