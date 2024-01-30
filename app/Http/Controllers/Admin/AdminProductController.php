<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Online Store";
        $viewData["products"] = Product::all();
        return view('admin.product.index')->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Online Store";

        $validated = $request->validate([
            'name' => 'required|unique:products,nombre|max:255',
            'price' => 'required|integer',
            'description' => 'required|max:1000',
        ]);

        $newObject = new Product;
        $newObject->nombre = $request->input('name');
        $newObject->precio = $request->input('price');
        $newObject->descripcion = $request->input('description');
        $newObject->save();

        $viewData["products"] = Product::all();
        return view('admin.product.index')->with("viewData", $viewData);
    }
}
