<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
    <h2>Edit Product</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST"  enctype="multipart/form-data" >
        @csrf
        @method('PUT')
        <!-- <div class="mb-3">
            <label>Image</label>
        <input type="file" name="images[]" multiple>
        </div> -->
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $product->name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="text" name="price" value="{{ $product->price }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

</body>
</html>