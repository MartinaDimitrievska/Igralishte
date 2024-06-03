<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Status;
use App\Models\Product;
use App\Models\Discount;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $colors = Color::all();
        $discounts = Discount::whereHas('status', function ($query) {
            $query->where('name', 'Active');
        })->get();
        return view('products.index', compact('products', 'colors', 'discounts'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        $brands = Brand::whereHas('status', function ($query) {
            $query->where('name', 'Active');
        })->get();

        $colors = Color::all();
        $sizes = Size::all();
        $statuses = Status::all();
        $tags = Tag::all();

        return view('products.create', compact('categories', 'brands', 'colors', 'sizes', 'statuses', 'tags'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'size_advice' => 'required|string',
            'maintenance' => 'required|string',
            'tags' => 'nullable|string',
            'product_category_id' => 'required|exists:product_categories,id',
            'brand_id' => 'required|exists:brands,id',
            'colors' => 'nullable|array',
            'sizes' => 'nullable|array',
            'status' => 'required|exists:statuses,id',
        ]);

        $product = new Product;
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->quantity = $validatedData['quantity'];
        $product->size_advice = $validatedData['size_advice'];
        $product->maintenance = $validatedData['maintenance'];
        $product->product_category_id = $validatedData['product_category_id'];
        $product->brand_id = $validatedData['brand_id'];
        $product->status_id = $validatedData['status'];

        $product->save();

        if (isset($validatedData['colors'])) {
            $product->colors()->attach($validatedData['colors']);
        }

        if (isset($validatedData['sizes'])) {
            $product->sizes()->attach($validatedData['sizes']);
        }

        if (isset($validatedData['tags'])) {
            $tagNames = explode(',', $validatedData['tags']);
            foreach ($tagNames as $tagName) {
                $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
                $product->tags()->attach($tag->id);
            }
        }

        if ($request->hasFile('images') && $request->file('images') !== null) {
            foreach ($request->file('images') as $image) {
                $filename = $image->store('product_images', 'public');
                $productImage = new ProductImage();
                $productImage->image = $filename;
                $productImage->product_id = $product->id;
                $productImage->save();
            }
        }

        return redirect()->route('products')->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        $statuses = Status::all();
        $sizes = Size::all();
        $colors = Color::all();
        $categories = ProductCategory::all();
        $brands = Brand::whereHas('status', function ($query) {
            $query->where('name', 'Active');
        })->get();

        $tags = Tag::all();

        return view('products.edit', compact('product', 'statuses', 'sizes', 'colors', 'categories', 'brands','tags'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'size_advice' => 'required|string',
            'maintenance' => 'required|string',
            'tags' => 'nullable|string',
            'product_category_id' => 'required|exists:product_categories,id',
            'brand_id' => 'required|exists:brands,id',
            'colors' => 'nullable|array',
            'sizes' => 'nullable|array',
            'status' => 'required|exists:statuses,id',
        ]);

        $product->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'quantity' => $validatedData['quantity'],
            'size_advice' => $validatedData['size_advice'],
            'maintenance' => $validatedData['maintenance'],
            'product_category_id' => $validatedData['product_category_id'],
            'brand_id' => $validatedData['brand_id'],
            'status_id' => $validatedData['status'],
        ]);

        if (isset($validatedData['colors'])) {
            $product->colors()->sync($validatedData['colors']);
        } else {
            $product->colors()->detach();
        }

        if (isset($validatedData['sizes'])) {
            $product->sizes()->sync($validatedData['sizes']);
        } else {
            $product->sizes()->detach();
        }

        if (isset($validatedData['tags'])) {
            $tagNames = explode(',', $validatedData['tags']);
            $tagIds = [];
            foreach ($tagNames as $tagName) {
                $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
                $tagIds[] = $tag->id;
            }
            $product->tags()->sync($tagIds);
        } else {
            $product->tags()->detach();
        }

        $existingImageIds = $product->images->pluck('id')->toArray();

        $updatedImageIds = $request->input('image_ids', []);
        $imagesToDelete = array_diff($existingImageIds, $updatedImageIds);
        ProductImage::whereIn('id', $imagesToDelete)->delete();

        if ($request->hasFile('images') && $request->file('images') !== null) {
            foreach ($request->file('images') as $image) {
                $filename = $image->store('product_images', 'public');
                $productImage = new ProductImage();
                $productImage->image = $filename;
                $productImage->product_id = $product->id;
                $productImage->save();
            }
        }

        return redirect()->route('products')->with('success', 'Product updated successfully');
    }

}
