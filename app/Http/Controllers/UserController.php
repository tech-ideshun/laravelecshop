<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;



class UserController extends Controller
{
  // userデータの取得
  public function index()
  {
    return view('user.index', ['user' => Auth::user()]);
  }
  // 会員編集
  public function edit(Request $request)
  {
    // 選択された会員の取得
    // $user= User::find($request->id);
// dd($user);
//  dd(decrypt(Auth::user()->password));   
    // try {
    //   $password = Crypt::decryptString(Auth::user()->password);
    //   return $password;
  // dd($password);
  // } catch (DecryptException $e) {
  //     //
  // }
//   $password = '';
//   $encryptedPassword = Auth::user()->password;
//   $decryptedPassword = decrypt($encryptedPassword);
//   $password == $decryptedPassword ;
// dd($password);
    return view('user.edit', [
      'user' => Auth::user(),
      // 'password' =>  $password
    ]);
  }


  public function update(Request $request)
  {
    $request->validate([
      'name' => ['required', 'string', 'max:255'],
    ]);
    // 選択された会員の取得
    $editUser = User::find($request->id);

    $editUser->name = $request->name;
    $editUser->email = $request->email;
    $editUser->password = $request->password;
    $editUser->post_number = $request->post_number;
    $editUser->address = $request->address;

    $editUser->save();

    return redirect()->route('products');
  }

  // 会員削除
  // public function delete()
  // {
  //   $user = User::find($request->id);
  //   $user->delete();
  //   return redirect()->route('user.index');
  // }
}
