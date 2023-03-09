<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClassController extends Controller
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
        $data = Classe::orderby('id','desc')->get();
        return response(
            view('class',compact('data'))
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
        $cek = Classe::where('grade',$request->grade)->where('major',$request->major)->count();
        if($cek!=0){
            return redirect('class')->with('errors','Kelas '.$request->grade.' - '.$request->major.' sudah ada sebelumnya!');
        }

        Classe::create([
            'grade'=>$request->grade,
            'major'=>$request->major,
        ]);
        return redirect('class')->with('success','Kelas Berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Class $class): Response
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $class)
    {
        return response()->json($class);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classe $class): RedirectResponse
    {
        $class->update([
            'grade'=>$request->grade,
            'major'=>$request->major,
        ]);
        return redirect('class')->with('success','Kelas Berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classe $class): RedirectResponse
    {
        $class->delete();
        return redirect('class')->with('success','Kelas Berhasil dihapus!');
    }
}
