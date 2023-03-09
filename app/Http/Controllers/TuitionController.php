<?php

namespace App\Http\Controllers;

use App\Models\Tuition;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TuitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $data = Tuition::orderby('id','desc')->get();
        return response(
            view('tuition',compact('data'))
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
        $cek = Tuition::where('enter',$request->enter)->where('out',$request->out)->count();
        if($cek!=0){
            return redirect('tuition')->with('errors','SPP '.$request->enter.'/'.$request->out.' sudah ada sebelumnya!');
        }

        Tuition::create([
            'enter'=>$request->enter,
            'out'=>$request->out,
            'price'=>$request->price,
        ]);
        return redirect('tuition')->with('success','SPP Berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Tuition $tuition): Response
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tuition $tuition)
    {
        return response()->json($tuition);

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tuition $tuition): RedirectResponse
    {
        $tuition->update([
            'enter'=>$request->enter,
            'out'=>$request->out,
            'price'=>$request->price,
        ]);
        return redirect('tuition')->with('success','SPP Berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tuition $tuition): RedirectResponse
    {
        $tuition->delete();
        return redirect('tuition')->with('success','SPP Berhasil dihapus!');
    }
}
