<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Mustakhik;


class KategoriController extends Controller
{
    //

    public function index()
    {
      // Mengambil semua kategori dan menghitung jumlah mustahik di setiap kategori
      $kategoriList = Kategori::withCount('mustahik')->get();

      return view('admin.kategori', ['kategoriList' => $kategoriList]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);


        // Create user
        Kategori::create([
            'name' => $request->name,
        ]);


        return redirect()->route('admin.kategori.index')->with('success', 'kategori added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $kategori = Kategori::findOrFail($id);

        $kategori->name = $request->name;
        $kategori->save();

        return redirect()->route('admin.kategori.index')->with('success', 'kategori data updated successfully.');
    }

    public function destroy($id)
    {
        $amil = Kategori::findOrFail($id);


        $amil->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'kategori data deleted successfully.');
    }


}