<!DOCTYPE html>
<html>
<head>
    <title>Product CRUD</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4>Create Product</h4>
                </div>

                <div class="card-body">
<form action="{{ route('products.store') }}" method="POST"  enctype="multipart/form-data" >
    @csrf

    <!-- Product Name -->
    <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" name="name" value="{{ old('name') }}"
            class="form-control @error('name') is-invalid @enderror"
            placeholder="Enter product name">   

        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Price -->
    <div class="mb-3">
        <label class="form-label">Price</label>
        <input type="number" name="price" value="{{ old('price') }}"
            class="form-control @error('price') is-invalid @enderror"
            placeholder="Enter price">

        @error('price')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- Description -->
    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description"
            class="form-control @error('description') is-invalid @enderror"
            rows="3"
            placeholder="Enter description">{{ old('description') }}</textarea>

        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>  
    <!-- Buttons -->
    <div class="d-flex justify-content-between">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-success">submit</button>
    </div>
    

</form>
    </div>
</div>

</div>
</div>
</div>

</body>
</html>