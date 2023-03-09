<?php

namespace App\Http\Controllers;

use App\Models\{User,Student,Special};
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(auth()->user()->level != 'admin'){
            return response(
                redirect('/home')->with('errors','Anda Tidak memiliki akses halaman tersebut!')
            );
        }
        $data = User::orderby('created_at','desc')->get();
        return response(
            view('user',compact('data'))
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create(): Response
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $cek = User::where('email',$request->email)->count();
        if($cek!=0){
            return redirect('user')->with('errors','User dengan email '.$request->email.' sudah ada sebelumnya!');
        }

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'level'=>$request->level,
            'password'=>Hash::make($request->password),
        ]);
        return redirect('user')->with('success','User Berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    // public function show(User $user): Response
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($r)
    {
        $user = User::where('id',$r)->first();
        return response()->json($user);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'level'=>$request->level,
            'password'=>Hash::make($request->password),
        ]);
        return redirect('user')->with('success','User Berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($r): RedirectResponse
    {
        User::where('id',$r)->delete();
        Student::where('nisn',$r)->delete();
        Special::where('nisn_fk_id',$r)->delete();
        return redirect('user')->with('success','User Berhasil dihapus!');
    }
}
