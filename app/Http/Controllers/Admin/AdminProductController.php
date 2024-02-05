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

        if ($request->hasFile("img")) {
            $fileEx = $request->file("img")->extension();
        }

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
        if ($request->hasFile("img")) {
            $fileEx = $lastInsertedId . "." . $request->file("img")->extension();
            Storage::disk('public')->put($fileEx, file_get_contents($request->file('img')->getRealPath())); //  
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
}
