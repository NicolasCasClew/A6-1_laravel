<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;



class ProductController extends Controller
{
    /*
    const products = [
        ["id" => 23, "nombre" => "Luna de Pluton", "descripcion" => "Mi libro, Luna de Plutón, ya está disponible en todas las librerías de Argentina, Chile, Uruguay, Paraguay, Bolivia, México, Perú, Colombia, Centroamérica, España, China, Japón, la Alemania Nazi, Guatemala, Sudáfrica, Brasil, la ciudad de Bagdad, el pueblo fantasma de Pripyat, Ucrania, la Antártida, el Polo Norte, Bangladesh, Corea del Norte, Namekusei, Ciudad Gótica, el Vaticano, el imperio Romano, Chernobyl, los abismos marinos, el estado de Pensilvania, Jerusalén, la isla de Poveglia en Italia, los poblados de Pompeya y Herculano, Camboya, Egipto, el pueblo de Baviera, Rusia, Turkmenistán, Italia, Inglaterra, Irak, la antigua Persia, el trecho de las Marianas", "url" => "/img/book.png", "precio" => 20],
        ["id" => 43, "nombre" => "Poly Station 5", "descripcion" => "1500 juegos preinstalados", "url" => "/img/game.png", "precio" => 150],
        ["id" => 65, "nombre" => "Caja Débil", "descripcion" => "Apta para guardar objetos no deseados", "url" => "/img/safe.png", "precio" => 350],
        ["id" => 75, "nombre" => "Daiads", "descripcion" => "Ole pa jugar al furbo viva el Beti", "url" => "/img/shoe.png", "precio" => 12],
        ["id" => 88, "nombre" => "Cyclops 2", "descripcion" => "Perfecto para ir a ver el Titanic con 4 amigos mas", "url" => "/img/submarine.png", "precio" => 250000]
    ];
*/
    public function index()
    {
        $products = Product::all();   //self::products;


        $viewData["products"] = $products;
        $viewData["title"] = "Productos - Tienda Online";
        $viewData["subtitle"] =  "Productos a la venta";
        return view("home.products")->with("viewData", $viewData);
    }

    public function show($id)
    {
        $products =   Product::find($id);  //self::products;

        $viewData["title"] = "Productos - Tienda Online";

        $viewData["id"] = $id;
        $viewData["name"] = $products["nombre"];
        $viewData["desc"] = $products["descripcion"];
        $viewData["url"] = $products["url"];


        /*
        for ($i = 0; $i < count($products); $i++) {
            if ($products[$i]["id"] == $id) {
                $viewData["name"] = $products[$i]["nombre"];
                $viewData["desc"] = $products[$i]["desc"];
                $viewData["url"] = $products[$i]["url"];
            }
        }*/

        //$viewData["subtitle"] =  "Productos a la venta";
        return view("home.product")->with("viewData", $viewData);
    }
}