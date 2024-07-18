<form method="POST" action="{{ route('register') }}"> @csrf
<div> <label>Category_Name</label> <input type="text" name="category_name" required> </div>

<div> <label>Category Description</label> <input type="text" name="category_description" required> </div>

<div> <label>Category Status</label> <input type="text" name="category_status" required> </div>


</div> <button type="submit">Register</button>


</form>

@forelse ($categories as $category)
    <li>{{ $category->name }} {{ $category->created_at }}</li>
@empty
    <p>No categories</p>
@endforelse
