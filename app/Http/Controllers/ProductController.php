<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            "foto" => "required|image|mimes:png,jpg,jpeg"
       ]);  

          // simpan foto ke folder storage/app/public/foto
        $foto = $request->file("foto");
        $path = $foto->store("foto", "public");

        // masukkan ke database
        Product::create([
            "nama"      => $validated["nama"],
            "harga"     => $validated["harga"],
            "deskripsi" => $validated["deskripsi"],
            "foto"      => $path, // simpan path lengkapnya
        ]);

      return redirect()->route("product.index")->with("success","add product success");

    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            "nama" => "required",
            "harga" => "required|numeric",
            "deskripsi" => "nullable",
            "foto" => "nullable|image|mimes:png,jpg,jpeg"
        ]);

        // Jika ada file foto baru diupload
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($product->foto && Storage::disk('public')->exists($product->foto)) {
                Storage::disk('public')->delete($product->foto);
            }
            $validated['foto'] = $request->file('foto')->store('foto', 'public');
        } else {
            // Jika tidak upload foto baru, gunakan foto lama
            $validated['foto'] = $product->foto;
        }

        $product->update($validated);

        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

public function destroy($id)
{
    $product = Product::findOrFail($id);

    // Hapus foto dari storage kalau ada
    if ($product->foto && Storage::disk('public')->exists($product->foto)) {
        Storage::disk('public')->delete($product->foto);
    }

    // Hapus data produk
    $product->delete();

    return redirect()->route('product.index')->with('success', 'Product deleted successfully');
}

  
}
