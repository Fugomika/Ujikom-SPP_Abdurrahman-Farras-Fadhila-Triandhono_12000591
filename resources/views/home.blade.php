@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <br>
                    <center><img src="https://smpit.assyifa-boardingschool.sch.id/wp-content/uploads/2019/09/Logo-SMPIT-fix-1024x1024.png" width="100"alt=""></center>
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status')}}
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <strong>Peringatan!</strong> {{$message}}
                    </div>
                    @endif
                    <br><br>
                    <center><h4>{{__("Selamat Datang, ".Str::ucfirst(Auth::user()->name).'!')}}</h4></center>
                    <br><br><br>
                    <center>
                        <i>"Bertakwa, cerdas, dan berkarakter pemimpin"</i>
                    </center>
                    <br><br><br>
                </div>
            </div>
            <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
        </div>
    </div>
</div>
@endsection
