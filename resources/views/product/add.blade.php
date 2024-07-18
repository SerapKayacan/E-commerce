<form method="POST" action="{{ route('register') }}"> @csrf
    <div> <label>Product_Name</label> <input type="text" name="product_name" required> </div>

    <div> <label>Product_CategoryId</label> <input type="text" name="product_categoryId" required> </div>

    <div> <label>Barcode</label> <input type="text" name="barcode" required> </div>

    <div> <label>Product_Status</label> <input type="text" name="product_status" required> </div>


</div> <button type="submit">Register</button>


</form>
