<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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

        /* if ($request->hasFile("img")) {
            $fileEx = $request->file("img")->extension();
        }*/

        $validated = $request->validate([
            'name' => 'required|unique:products,nombre|max:255',
            'price' => 'required|integer|gt:0',
            'description' => 'required|max:1000',
            'image' => 'required',
        ]);

        //test
        $newObject = new Product;
        $newObject->nombre = $request->input('name');
        $newObject->precio = $request->input('price');
        $newObject->descripcion = $request->input('description');
        $newObject->save();

        $lastInsertedId = $newObject->id;
        //dd($request->all(), $request->hasFile("image"));
        if ($request->hasFile("image")) {
            $fileEx = $lastInsertedId . "." . $request->file("image")->extension();
            Storage::disk('public')->put($fileEx, file_get_contents($request->file('image')->getRealPath())); //  
            Product::where('id', $lastInsertedId)->update(array('url' => "/storage/" . $fileEx));
        }

        return back()->withInput();
    }

    public function destroy($id)
    {
        $url = Product::where('id', $id)->first()->url;

        Storage::disk('public')->delete(basename($url));
        Product::destroy($id);

        return back()->withInput();
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Online Store";
        $viewData["id"] = $product["id"];
        $viewData["name"] = $product["nombre"];
        $viewData["price"] = $product["precio"];
        $viewData["desc"] = $product["descripcion"];
        $viewData["url"] = $product["url"];
        return view('admin.product.edit')->with("viewData", $viewData);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->nombre = $request->input("name");
        $product->precio = $request->input("price");
        $product->descripcion = $request->input("description");

        //$product->nombre = $request->input("nombre");
        if ($request->hasFile("image")) {
            Storage::disk('public')->delete(basename($product->url));

            $lastInsertedId = $product->id;
            $fileEx = $lastInsertedId . "." . $request->file("image")->extension();
            Storage::disk('public')->put($fileEx, file_get_contents($request->file('image')->getRealPath()));

            $product->url = "/storage/" . $fileEx;
            //Product::where('id', $lastInsertedId)->update(array('url' => "/storage/" . $fileEx));
        }
        $product->update();

        $viewData = [];
        $viewData["title"] = "Admin Page - Products - Online Store";
        $viewData["products"] = Product::all();
        return view('admin.product.index')->with("viewData", $viewData);
    }
}