<?php

namespace App\Http\Controllers;

use App\Models\{Special,MutationViews,Student};
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MutationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        if(auth()->user()->level != 'admin'){
            return response(
                redirect('/home')->with('error','Anda Tidak memiliki akses halaman tersebut!')
            );
        }
        $data = MutationViews::orderby('id','desc')->get();
        $s = Student::all();
        return response(
            view('mutation',compact('data','s'))
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
        $cek = MutationViews::where('nisn_fk_id',$request->nisn_fk_id)->count();
        if($cek!=0){
            return redirect('mutation')->with('error','Mutasi '.$request->nisn_fk_id.' sudah ada sebelumnya!');
        }

        Special::create([
            'nisn_fk_id'=>$request->nisn_fk_id,
            'reduction'=>$request->reduction,
        ]);
        return redirect('mutation')->with('success','Data Mutasi Berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Special $mutation): Response
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MutationViews $mutation)
    {
        return response()->json($mutation);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Special $mutation): RedirectResponse
    {
        $mutation->update([
            'reduction'=>$request->reduction,
        ]);
        return redirect('mutation')->with('success','Data Mutasi Berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Special $mutation): RedirectResponse
    {
        $mutation->delete();
        return redirect('mutation')->with('success','Data Mutasi Berhasil dihapus!');
    }
}
