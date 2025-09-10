<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(){
        $products = Product::paginate(9);
        return view ("product.index", compact ("products"));
    }
    public function create(){
        return view("product.create");
    }

    public function store(Request $request){
       $validated=  $request->validate([
            "nama"=> "required",
            "harga"=> "required|numeric",
            "deskripsi"=> "nullable",
            "foto" => "required|image|mimes:png,jpg"
       ]);

       $foto = $request->file("foto");
       $foto->storeAs('public', $foto->hashName());
        Product::create([
        "nama"      => $validated["nama"],
        "harga"     => $validated["harga"],
        "deskripsi" => $validated["deskripsi"],
        "foto"      => $foto->hashName(),
    ]);
      return redirect()->route("product.index")->with("success","add product success");

    }
}
