<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductImage;
use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\File; 

// pp/Http/Controllers/ProductController.php

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Product::query();

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $products = $query->paginate(4)->withQueryString();

    return view('products.index', compact('products'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'price' => 'required|numeric',
        'description' => 'required'
    ]);
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $file) {

            $imageName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('products'), $imageName);

            ProductImage::create([
                'product_id' => $product->id,
                'image' => $imageName
            ]);
        }
    }

    if ($validator->fails()) {
        return redirect()->route('products.create')->withErrors($validator)->withInput();
    }

    Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description
    ]);

    return redirect()->route('products.index')->with('success', 'Product added successfully');
} 
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $product = Product::findOrFail($id);
    return view('products.edit', compact('product'));
}

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $product->name = $request->name;
    $product->price = $request->price;
    $product->description = $request->description;

    // ✅ IMAGE UPDATE SAFE HANDLING
    if ($request->hasFile('image')) {

        // delete old image if exists
        if ($product->image && File::exists(public_path('uploads/products/' . $product->image))) {
            File::delete(public_path('uploads/products/' . $product->image));
        }

        // upload new image
        $file = $request->file('image');
        $imageName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/products'), $imageName);

        $product->image = $imageName;
    }

    $product->save();

    return redirect()->route('products.index')->with('success', 'Product updated successfully');
}
    /**
     * Remove the specified resource from storage.
     */
public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->route('products.index')->with('success', 'Product deleted successfully');
}
}
