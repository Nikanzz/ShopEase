<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage {{$product->name}}</title>
</head>
<body>
    <h1>Product Details</h1>
    <form method="POST" action="{{ route('change.product') }}">
        @csrf
        <input type="hidden" name="id" value="{{$product->id}}">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" maxlength="50" value="{{$product->name}}"><br><br>
        <label for="description">Description</label>
        <input type="text" id="description" name="description" value="{{$product->description}}"><br><br>
        <label for="price">Price</label>
        <input type="number" id="price" name="price" value="{{$product->price}}"><br><br>
        <label for="stock">Stock</label>
        <input type="number" id="stock" name="stock" value="{{$product->stock}}"><br><br>
        <label for="categories">Category</label>
        <select name="category_id" id="categories">
            @foreach(DB::table('categories')->get() as $category)
                @if($category->id==$product->category_id)
                    <option selected value="{{$category->id}}">{{$category->name}}</option>
            `   @else
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endif
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