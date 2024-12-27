<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masjid;
use App\Models\Muzaki;

class MasjidController extends Controller
{
    //
    public function index()
    {
      // Mengambil semua kategori dan menghitung jumlah mustahik di setiap kategori
      $masjidList = Masjid::withCount('muzaki')->get();

      return view('admin.masjid', ['masjidList' => $masjidList]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:100',
            'RT' => 'required|integer|max:100',
            'RW' => 'required|integer|max:100',
        ]);


        // Create user
        Masjid::create([
            'name' => $request->name,
            'address' => $request->address,
            'RT' => $request->RT,
            'RW' => $request->RW,
        ]);


        return redirect()->route('admin.masjid.index')->with('success', 'masjid added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|string|max:100',
            'address' => 'sometimes|string|max:100',
            'RT' => 'sometimes|integer|max:100',
            'RW' => 'sometimes|integer|max:100',
        ]);
    
        // Temukan masjid berdasarkan ID
        $masjid = Masjid::findOrFail($id);
    
        // Update data dengan input yang diberikan
        $masjid->update($request->only(['name', 'address', 'RT', 'RW']));
    
        return redirect()->route('admin.masjid.index')->with('success', 'Masjid data updated successfully.');
    }
    

    public function destroy($id)
    {
        $amil = Masjid::findOrFail($id);


        $amil->delete();

        return redirect()->route('admin.masjid.index')->with('success', 'Masjid data deleted successfully.');
    }
}