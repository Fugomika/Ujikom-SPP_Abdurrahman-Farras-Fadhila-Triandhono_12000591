<?php

namespace App\Http\Controllers;

use App\Models\{PaymentViews,Payment,Student,StudentViews,Special};
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $data = PaymentViews::orderby('id','desc')->get();
        $s = Student::all();
        return response(
            view('payment',compact('data','s'))
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $s = StudentViews::where('nisn',request()->nisn)->first();
        $count = PaymentViews::where('nisn_fk_id',request()->nisn)->count();
        $l = PaymentViews::where('nisn_fk_id',request()->nisn)->orderBy('id','desc')->first();
        $special = Special::where('nisn_fk_id',request()->nisn)->first();

        if($count == 0){
            $max = 36;
            $last = "Siswa belum pernah membayar SPP";
        }elseif($count == 36){
            $max = 0;
            $last = "<span class='text-danger'>SPP Siswa sudah lunas</span>";
        }else{
            $max = 36 - $count;
            $last = "Terakhir bayar bulan ".$l->month_name." - ".$l->year;
        }
        if(!empty($special)){
            $plus = 36 - $special->reduction;
            $max -= $special->reduction;
            if($count == $plus){
                $last = "<span class='text-danger'>SPP Siswa sudah lunas</span>";
            }else{
                $last = "Terakhir bayar bulan ".$l->month_name." - ".$l->year;
            }
        }

        return response()->json([
                'student'=>$s,
                'max'=>$max,
                'last'=>$last
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $p = PaymentViews::where('nisn_fk_id',$request->nisn_fk_id)->orderBy('id','desc')->first();
        $s = StudentViews::where('nisn',$request->nisn_fk_id)->first();

        if(empty($p)){
            $month = 7;
            $year = $s->enter;
        }else{
            $month = $p->month + 1;
            $year = $p->year;
        }

        for ($i=0; $i < $request->qty; $i++) { 

            if($month == 13){
                $month = 1;
                $year++;
            }

            Payment::create([
                'user_fk_id'=>auth()->user()->id,
                'nisn_fk_id'=>$request->nisn_fk_id,
                'month'=>$month,
                'year'=>$year,
            ]);

            $month++;
        }
        
        return redirect('payment')->with('success','Pembayaran Berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentViews $payment)
    {
        $s = StudentViews::where('nisn',$payment->nisn_fk_id)->first();
        $special = Special::where('nisn_fk_id',$payment->nisn_fk_id)->first();

        if(!empty($special)){
            if($special->reduction == 24){
                $special = "XII";
            }elseif($special->reduction == 12){
                $special = "XI";
            }
        }

        return response()->json([
            'student'=>$s,
            'payed'=>$payment,
            'special'=>$special
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        $s = StudentViews::where('nisn',$payment->nisn_fk_id)->first();
        return response()->json([
                'payed'=>$payment,
                'student'=>$s,
            ]);
    }


    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Payment $payment): RedirectResponse
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Payment $payment): RedirectResponse
    // {
    //     //
    // }
}
