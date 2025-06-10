
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{DB::table('sellers')->where('user_id' , Auth::user()->id)->first()->shopname}} Products</title>
</head>
<body>
    <h1>{{DB::table('sellers')->where('user_id' , Auth::user()->id)->first()->shopname }}'s Products</h1>
    <form method="GET" action="{{ route('dashboard') }}">
        @csrf
        <button type="submit">Back to DashBoard</button>
    </form>
    <br>
    <form method="GET" action="{{ route('create.product') }}">
        @csrf
        <button type="submit">Create Product</button>
    </form>
    <br>

    <table border="1" cellpadding="5" cellspacing="0"> 
      <thead> 
        <tr> 
          <th style="width: 50px">Product id</th> 
          <th style="width: 100px">Product name</th> 
          <th style="width: 300">Description</th> 
          <th style="width: 120px">Price</th>
          <th style="width: 120px">Stock</th>
          <th style="width: 120px">Category</th>
        </tr> 
      </thead> 
      <tbody> 
        @foreach($products as $p) 
          <tr> 
            <td> 
              {{$p->id}} 
            </td> 
            <td> 
              {{$p->name}}
            </td>
            <td> 
              {{$p->description}}
            </td> 
            <td> 
              {{$p->price}}
            </td>
            <td> 
              {{$p->stock}}
            </td>
            <td> 
              {{DB::table('categories')->where('id' , $p->category_id)->first()->name}}
            </td>
          </tr> 
        @endforeach 
      </tbody> 
    </table> 
</body>
</html>