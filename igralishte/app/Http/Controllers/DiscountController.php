<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Product;
use App\Models\Discount;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DiscountCategory;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();
        return view('discounts.index', compact('discounts'));
    }

    public function create()
    {
        $categories = DiscountCategory::all();
        $statuses = Status::all();
        $products = Product::all();

        return view('discounts.create', compact('categories', 'statuses','products'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'discount' => 'required',
            'discount_category_id' => 'required|exists:discount_categories,id',
            'products' => 'nullable|string',
            'status' => 'required|exists:statuses,id',
        ]);

        if (isset($validatedData['products'])) {
            $productNames = explode(',', $validatedData['products']);
            foreach ($productNames as $productName) {
                $productID = Str::after($productName, '#');
                $product = Product::find($productID);
            }
        }

        $discount = new Discount;
        $discount->name = $validatedData['name'];
        $discount->discount = $validatedData['discount'];
        $discount->discount_category_id = $validatedData['discount_category_id'];
        $discount->status_id = $validatedData['status'];
        $discount->save();

        if (isset($validatedData['products'])) {
            foreach ($productNames as $productName) {
                $productID = Str::after($productName, '#');
                $product = Product::find($productID);
                if ($product) {
                    $discount->products()->attach($product->id);
                }
            }
        }

        return redirect()->route('discounts')->with('success', 'Discount created successfully');
    }

    public function edit(Discount $discount)
    {
        $categories = DiscountCategory::all();
        $statuses = Status::all();
        $products = Product::all();

        return view('discounts.edit', compact('discount', 'statuses', 'categories', 'products'));
    }

    public function update(Request $request, Discount $discount)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'discount' => 'required',
            'discount_category_id' => 'required|exists:discount_categories,id',
            'products' => 'nullable|string',
            'status' => 'required|exists:statuses,id',
        ]);

        $discount->update([
            'name' => $validatedData['name'],
            'discount' => $validatedData['discount'],
            'discount_category_id' => $validatedData['discount_category_id'],
            'status_id' => $validatedData['status'],
        ]);

        if (isset($validatedData['products'])) {
            $productNames = explode(',', $validatedData['products']);
            $productIds = [];
            foreach ($productNames as $productName) {
                $productID = Str::after($productName, '#');
                $product = Product::find($productID);
                if ($product) {
                    $productIds[] = $product->id;
                }
            }
            $discount->products()->sync($productIds);
        }

        return redirect()->route('discounts')->with('success', 'Discount updated successfully');
    }
}
