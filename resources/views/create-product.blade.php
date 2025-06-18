<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Product</title>
</head>
<body>
    <h1>Product Details</h1>
    <form method="POST" action="{{ route('new.product') }}">
        @csrf
        <label for="name">Name</label>
        <input type="text" id="name" name="name" maxlength="50" ><br><br>
        <label for="description">Description</label>
        <textarea id="description" name="description"></textarea><br><br>
        <label for="price">Price</label>
        <input type="number" id="price" name="price" min="0" max="500000000"><br><br>
        <label for="stock">Stock</label>
        <input type="number" id="stock" name="stock" min="0" max="500000000"><br><br>
        <label for="categories">Category</label>
        <select name="categories" id="categories">
            @foreach(DB::table('categories')->get() as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select><br><br>
        <button type="submit">Submit</button>
    </form>

    <form method="GET" action="{{ route('product.list') }}">
        @csrf
        <br><br><button type="submit">Cancel</button>
    </form>
</body>
</html>