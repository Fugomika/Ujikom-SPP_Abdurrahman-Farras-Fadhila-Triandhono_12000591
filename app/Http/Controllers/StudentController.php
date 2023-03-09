<?php

namespace App\Http\Controllers;

use App\Models\{Tuition,Classe,StudentViews,Student,User,Special,PaymentViews};
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
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
        $t = Tuition::all();
        $c = Classe::all();
        $data = StudentViews::orderby('created_at','desc')->get();
        return response(
            view('student',compact('data','t','c'))
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        if(auth()->user()->level != 'student'){
            return response(
                redirect('/home')->with('errors','Anda Tidak memiliki akses halaman tersebut!')
            );
        }
        $data = PaymentViews::where('nisn_fk_id',auth()->user()->id)->orderby('id','desc')->get();
        $s = StudentViews::where('nisn',auth()->user()->id)->first();
        return response(
            view('history',compact('data','s'))
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $cek = Student::where('nisn',$request->nisn)->count();
        if($cek!=0){
            return redirect('student')->with('errors','Siswa dengan NISN '.$request->nisn.' sudah ada sebelumnya!');
        }

        $c = Classe::where('id',$request->class_fk_id)->first();

        Student::create([
            'nisn'=>$request->nisn,
            'nis'=>$request->nis,
            'name'=>$request->name,
            'class_fk_id'=>$request->class_fk_id,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'tuition_fk_id'=>$request->tuition_fk_id,
        ]);

        User::create([
            'id'=>$request->nisn,
            'name'=>$request->name,
            'email'=>$request->nisn.'@asbosch.id',
            'level'=>'student',
            'password'=>Hash::make($request->nisn),
        ]);

        if($c->grade == "XII"){
            Special::Create([
                'nisn_fk_id'=>$request->nisn,
                'reduction'=>24,
            ]);
        }elseif($c->grade == "XI"){
            Special::Create([
                'nisn_fk_id'=>$request->nisn,
                'reduction'=>12,
            ]);
        }

        return redirect('student')->with('success','Siswa Berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show($r)
    {
        $s = StudentViews::where('nisn',$r)->first();
        $payed = PaymentViews::where('nisn_fk_id',$r)->get();
        $special = Special::where('nisn_fk_id',$r)->first();

        if(!empty($special)){
            if($special->reduction == 24){
                $special = "XII";
            }elseif($special->reduction == 12){
                $special = "XI";
            }
        }

        return response()->json([
            'student'=>$s,
            'payed'=>$payed,
            'special'=>$special
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($r)
    {
        $student = StudentViews::where('nisn',$r)->first();
        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        
        Student::where('nisn',$request->nisn)->update([
            'nisn'=>$request->nisn,
            'nis'=>$request->nis,
            'name'=>$request->name,
            'class_fk_id'=>$request->class_fk_id,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'tuition_fk_id'=>$request->tuition_fk_id,
        ]);
        return redirect('student')->with('success','Siswa Berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($r): RedirectResponse
    {
        User::where('id',$r)->delete();
        Student::where('nisn',$r)->delete();
        Special::where('nisn_fk_id',$r)->delete();
        return redirect('student')->with('success','Siswa Berhasil dihapus!');
    }
}
