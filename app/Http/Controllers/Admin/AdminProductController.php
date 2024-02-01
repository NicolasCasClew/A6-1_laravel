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

        if ($request->hasFile("img")) {
            $fileEx = $request->file("img")->extension();
        }

        $validated = $request->validate([
            'name' => 'required|unique:products,nombre|max:255',
            'price' => 'required|integer|gt:0',
            'description' => 'required|max:1000',
        ]);

        //test
        $newObject = new Product;
        $newObject->nombre = $request->input('name');
        $newObject->precio = $request->input('price');
        $newObject->descripcion = $request->input('description');
        $newObject->save();

        //Product::orderBy('id', 'desc')->first();
        $lastInsertedId = $newObject->id;
        if ($request->hasFile("img")) {
            $fileEx = $lastInsertedId . "." . $request->file("img")->extension();

            Product::where('id', $lastInsertedId)->update(array('url' => $fileEx));
        }



        $viewData["products"] = Product::all();
        return view('admin.product.index')->with("viewData", $viewData);
    }
}
