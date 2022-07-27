<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ValidateRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        $checkrole = explode(',', $role);
        if (in_array('1', $checkrole)) {
            return redirect('/admin');
        } elseif(in_array('2', $checkrole)) {
            return redirect('/products');
        }
    }

    protected function loggedOut(Request $request)
     {
         return redirect(route('products'));
     }
}
