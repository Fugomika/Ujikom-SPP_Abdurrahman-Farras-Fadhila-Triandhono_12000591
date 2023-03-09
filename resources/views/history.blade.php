@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                            <h5>Siswa</h5>
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">Nama</div>
                            <div class="col" id="name">{{$s->name}}</div>
                        </div>
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">NISN</div>
                            <div class="col" id="nisn">{{$s->nisn}}</div>
                        </div>
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">NIS</div>
                            <div class="col" id="nis">{{$s->nis}}</div>
                        </div>
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">Kelas</div>
                            <div class="col" id="class">{{$s->grade}} - {{$s->major}}</div>
                        </div>
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">Tahun Masuk/Keluar</div>
                            <div class="col" id="year">{{$s->enter}}/{{$s->out}}</div>
                        </div>
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">Alamat</div>
                            <div class="col" id="address">{{$s->address}}</div>
                        </div>
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">No. Handphone</div>
                            <div class="col" id="phone">{{$s->phone}}</div>
                        </div>
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">Sudah Dibayar</div>
                            <div class="col" id="phone">{{count($data)}} Bulan</div>
                        </div>
                </div>
                <div class="card-header">
                    <h4>Riyawat Pembayaran</h4>
                    <br>
                    <button type="button" data-id="{{$s->nisn}}" class="receipt2 btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalReceipt">
                        Lihat Semua
                    </button>

                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <strong>Berhasil!</strong> {{$message}}
                    </div>
                @endif
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <strong>Peringatan!</strong> {{$message}}
                    </div>
                @endif
                
                <div class="card-body">
                    <br>
                    <table class="table display">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pada</th>
                                <th>Pembayaran</th>
                                <th>Petugas</th>
                                <th>Dibayar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <?php
                        $no = 1;
                        ?>
                        <tbody>
                            @foreach ($data as $a)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$a->created_at}}</td>
                                    <td>{{$a->month_name}} - {{$a->year}}</td>
                                    <td>{{$a->treasurer}}</td>
                                    <td>{{$a->price}}</td>
                                    <td><span style="display:none;">{{$a->created_at}}</span>
                                        <button type="button" data-id="{{$a->id}}" class="receipt btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalReceipt">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('receipt')
@endsection

@section('script')
<script>
    $('.receipt').on('click',function(){
        let url = "{{ route('payment.show',':id') }}";
        url = url.replace(':id',$(this).attr('data-id'));

        $.ajax({
            url:url,
            method:'get',
            success: function(data){
                $('#rname').html(data["student"]["name"]);
                $('#rnisn').html(data["student"]["nisn"]);
                $('#rnis').html(data["student"]["nis"]);
                $('#rclass').html(data["student"]["grade"]+" - "+data["student"]["major"]);
                $('#ryear').html(data["student"]["enter"]+"/"+data["student"]["out"]);
                $('#raddress').html(data["student"]["address"]);
                $('#rphone').html(data["student"]["phone"]);
                $('#jumlahh').html('<b>Tanggal</b>');

                $('#rspp').append('<div class="row justify-content-center align-items-center g-2"> <div class="col">'+data["payed"]["month_name"]+' - '+data["payed"]["year"]+'</div> <div class="col">'+data["payed"]["treasurer"]+'</div> <div class="col">'+data["payed"]["created_at"].slice(0,10)+'</div><div class="col">Rp.'+data["payed"]["price"]+'</div> </div>');
                // jQuery.each(data["payed"][0],function(i,val){
                //     $('#rspp').append('<div class="row justify-content-center align-items-center g-2"> <div class="col">'+data["payed"]["month_name"]+'</div> <div class="col">'+data["payed"]["treasurer"]+'</div> <div class="col">'+data["payed"]["created_at"]+'</div> <div class="col">'+data["payed"]["price"]+'</div> </div>');
                // });
            }
        });
    })

    $('.receipt2').on('click',function(){
        let url = "{{ route('student.show',':id') }}";
        url = url.replace(':id',$(this).attr('data-id'));
        console.log(url);
        $.ajax({
            url:url,
            method:'get',
            success: function(data){
                $('#hide').show();
                $('#rname').html(data["student"]["name"]);
                $('#rnisn').html(data["student"]["nisn"]);
                $('#rnis').html(data["student"]["nis"]);
                $('#rclass').html(data["student"]["grade"]+" - "+data["student"]["major"]);
                $('#ryear').html(data["student"]["enter"]+"/"+data["student"]["out"]);
                $('#raddress').html(data["student"]["address"]);
                $('#rphone').html(data["student"]["phone"]);

                jQuery.each(data["payed"],function(i,val){
                    $('#rspp2').append('<div class="row justify-content-center align-items-center g-2"> <div class="col">'+val["month_name"]+' - '+val["year"]+'</div> <div class="col">'+val["treasurer"]+'</div> <div class="col">'+val["created_at"].slice(0,10)+'</div> <div class="col">1</div> <div class="col">Rp. '+val["price"]+'</div> </div>');
                });

                var last = data["payed"][data["payed"].length-1];
                var first = data["payed"][0];
                $('#rspp').append('<div class="row justify-content-center align-items-center g-2"> <div class="col">'+first["month_name"]+' - '+first["year"]+' Sampai '+last["month_name"]+' - '+last["year"]+'</div> <div class="col">'+first["treasurer"]+'</div> <div class="col">'+data["payed"].length+'</div> <div class="col">Rp. '+first["price"]+'</div> </div>');
                $('#rspp').append('<hr><div class="row justify-content-center align-items-center g-2"> <div class="col-10"><b>Total: Rp. '+data["payed"].length*first["price"]+'</b></div></div>');

            }
        });
    })

    $('#modalReceipt').on('hide.bs.modal',function(){
        setTimeout(() => {
            console.log('ke hide ges')
                $('#jumlahh').html('<b>Jumlah</b>');
                $('#hide').hide();
                $('#rname').html();
                $('#rnisn').html();
                $('#rnis').html();
                $('#rclass').html();
                $('#ryear').html();
                $('#raddress').html();
                $('#rphone').html();
                $('#rspp2').empty();
                $('#rspp').empty();
        }, 500);
    });
</script>
@endsection
