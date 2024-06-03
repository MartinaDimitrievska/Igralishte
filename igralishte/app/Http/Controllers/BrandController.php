<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Brand;
use App\Models\Status;
use App\Models\BrandImage;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('brands.index', compact('brands'));
    }

    public function create()
    {
        $statuses = Status::all();
        $categories = ProductCategory::all();
        $tags = Tag::all();

        return view('brands.create', compact('statuses', 'categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'tags' => 'nullable|string',
            'status' => 'required|exists:statuses,id',
            'categories' => 'nullable|array',
        ]);

        $brand = new Brand;
        $brand->name = $validatedData['name'];
        $brand->description = $validatedData['description'];
        $brand->status_id = $validatedData['status'];

        $brand->save();

        if (isset($validatedData['categories'])) {
            $brand->categories()->attach($validatedData['categories']);
        }

        if (isset($validatedData['tags'])) {
            $tagNames = explode(',', $validatedData['tags']);
            foreach ($tagNames as $tagName) {
                $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
                $brand->tags()->attach($tag->id);
            }
        }

        if ($request->hasFile('images') && $request->file('images') !== null) {
            foreach ($request->file('images') as $image) {
                $filename = $image->store('brand_images', 'public');
                $brandImage = new BrandImage();
                $brandImage->image = $filename;
                $brandImage->brand_id = $brand->id;
                $brandImage->save();
            }
        }

        return redirect()->route('brands')->with('success', 'Brand created successfully');
    }

    public function edit(Brand $brand)
    {
        $statuses = Status::all();
        $categories = ProductCategory::all();
        $tags = Tag::all();

        return view('brands.edit', compact('brand', 'statuses', 'categories', 'tags'));
    }

    public function update(Request $request, Brand $brand)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'tags' => 'nullable|string',
            'status' => 'required|exists:statuses,id',
            'categories' => 'nullable|array',
        ]);

        $brand->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'status_id' => $validatedData['status'],
        ]);

        if (isset($validatedData['categories'])) {
            $brand->categories()->sync($validatedData['categories']);
        } else {
            $brand->categories()->detach();
        }

        if (isset($validatedData['tags'])) {
            $tagNames = explode(',', $validatedData['tags']);
            $tagIds = [];
            foreach ($tagNames as $tagName) {
                $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
                $tagIds[] = $tag->id;
            }
            $brand->tags()->sync($tagIds);
        } else {
            $brand->tags()->detach();
        }

        $existingImageIds = $brand->images->pluck('id')->toArray();

        $updatedImageIds = $request->input('image_ids', []);
        $imagesToDelete = array_diff($existingImageIds, $updatedImageIds);
        BrandImage::whereIn('id', $imagesToDelete)->delete();

        if ($request->hasFile('images') && $request->file('images') !== null) {
            foreach ($request->file('images') as $image) {
                $filename = $image->store('brand_images', 'public');
                $brandImage = new BrandImage();
                $brandImage->image = $filename;
                $brandImage->brand_id = $brand->id;
                $brandImage->save();
            }
        }

        return redirect()->route('brands')->with('success', 'Brand updated successfully');
    }
}
