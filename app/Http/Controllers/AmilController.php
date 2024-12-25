<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Amil;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AmilController extends Controller
{

    public function index()
    {
        $amilList = Amil::all();
        return view('admin.amil', ['amilList' => $amilList]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:tbl_amil',
            'address' => 'required',
            'username' => 'required|unique:tbl_users',
            'password' => 'required',
            'imageProfile' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
        ]);

        // Upload gambar
        if ($request->hasFile('imageProfile')) {
            $image = $request->file('imageProfile');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('profiles'), $imageName); // Pindahkan file ke public/profiles
            $imagePath = 'profiles/' . $imageName;
        } else {
            $imagePath = null;
        }

        // Create user
        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'amil',
            'status' => 'aktif',
        ]);

        // Create amil and associate with user
        $amil = Amil::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'imageProfile' => $imagePath,
            'id_amil' => $user->id,
        ]);

        return redirect()->route('admin.amil')->with('success', 'Amil added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'imageProfile' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
        ]);

        $amil = Amil::findOrFail($id);

        // Upload gambar jika ada perubahan
        if ($request->hasFile('imageProfile')) {
            // Hapus gambar lama jika ada
            if ($amil->imageProfile) {
                @unlink(public_path($amil->imageProfile));
            }

            // Simpan gambar baru
            $image = $request->file('imageProfile');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('profiles'), $imageName); // Pindahkan file ke public/profiles
            $imagePath = 'profiles/' . $imageName;

            $amil->imageProfile = $imagePath;
        }

        $amil->name = $request->name;
        $amil->phone = $request->phone;
        $amil->address = $request->address;
        $amil->save();

        return redirect()->route('admin.amil')->with('success', 'Amil data updated successfully.');
    }

    public function destroy($id)
    {
        $amil = Amil::findOrFail($id);

        // Hapus gambar profil jika ada sebelum menghapus amil
        if ($amil->imageProfile) {
            @unlink(public_path($amil->imageProfile));
        }

        // Hapus user yang terkait dengan amil
        if ($amil->user) {
            $amil->user->delete();
        }

        // Hapus data amil
        $amil->delete();

        return redirect()->route('admin.amil')->with('success', 'Amil dan akun terkait berhasil dihapus.');
    }

    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'non-aktif';
        $user->save();

        return redirect()->route('admin.amil')->with('success', 'Amil deactivated successfully.');
    }

    public function activate($id)
    {
        $user = User::findOrFail($id);
        if ($user->role !== 'amil') {
            return redirect()->route('admin.amil')->with('error', 'This user is not an amil.');
        }

        $user->status = 'aktif';
        $user->save();

        return redirect()->route('admin.amil')->with('success', 'Amil activated successfully.');
    }

    public function updatePasswordUsername(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|min:6',
            'username' => 'required|unique:tbl_users,username,' . $id,
        ]);

        $user = User::findOrFail($id);
        $user->password = bcrypt($request->password);
        $user->username = $request->username;
        $user->save();

        return redirect()->route('admin.amil')->with('success', 'Password & Username updated successfully.');
    }

}