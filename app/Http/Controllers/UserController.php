<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Make sure to import the User model
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
public function dashboard()
    {
        $user = Auth::user();

        return view('dashboard-admin', ['user' => $user]);
    }
}