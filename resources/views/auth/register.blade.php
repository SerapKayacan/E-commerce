<form method="POST" action="{{ route('register') }}"> @csrf <div> <label>Name</label> <input type="text" name="name"
            required> </div>
    <div> <label>Email</label> <input type="email" name="email" required> </div>
    <div> <label>Password</label> <input type="password" name="password" required> </div>
    <div> <label>Password</label> <select name="type" id="type">
            <option value="1">Customer</option>
            <option value="2">Seller</option>
        </select> </div>
    <div> <label>Confirm Password</label> <input type="password" name="password_confirmation" required> </div> <button
        type="submit">Register</button>




</form>
