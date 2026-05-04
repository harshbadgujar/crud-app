<!DOCTYPE html>
<html>
<head>
    <title>Product CRUD</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4">Product List</h2>

    <!-- Add Button -->
    <div class="mb-3">
        <a href="{{ route('products.create') }}" class="btn btn-primary">+ Add Product</a>
    </div>

        <form method="GET" action="{{ route('products.index') }}">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product..." class="form-control">
                <button class="btn btn-primary mt-2">Search</button>
                </form>
                </div>
    <!-- Table -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th width="180px">Action</th>
            </tr>
        </thead>

        <tbody>
<!-- Dummy Data Row -->
@foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->description }}</td>
                <td>
                    <!-- Edit -->
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">
                        Edit
        </a>

        <!-- Delete -->
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')

                <button type="submit" class="btn btn-danger btn-sm"
                onclick="return confirm('Are you sure?')">
                Delete
            </button>
        </form>
    </td>
</tr>
@endforeach
</tbody>
</table>

Total: {{ $products->total() }} 
Per Page: {{ $products->perPage() }}
{{ $products->links('pagination::bootstrap-5') }}
<div>
    </div>
</div>

</body>
</html>