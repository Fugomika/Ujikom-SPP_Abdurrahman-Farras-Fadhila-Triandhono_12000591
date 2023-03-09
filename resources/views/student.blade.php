@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Siswa</h4>
                    <br>
                    <button type="button" class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#modal">
                        <i class="bi bi-plus"></i>Tambah Siswa
                    </button>
                    @include('studentModal')
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
                                <th>NISN</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Tahun Masuk/Keluar</th>
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
                                    <td>{{$a->nisn}}</td>
                                    <td>{{$a->nis}}</td>
                                    <td>{{$a->name}}</td>
                                    <td>{{$a->grade}} - {{$a->major}}</td>
                                    <td>{{$a->enter}}/{{$a->out}}</td>
                                    <td><span style="display:none;">{{$a->created_at}}</span>
                                        <form action="{{route('student.destroy',$a->nisn)}}" method="post" id="form-delete">
                                            @csrf
                                            @method('delete')
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" data-id="{{$a->nisn}}" class="edit btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button type="button" data-id="{{$a->nisn}}" class="receipt btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalReceipt">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button type="button" data-id="Yakin ingin menghapus Data {{$a->name}}?" class="delete btn btn-outline-danger">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </div>
                                        </form>
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
    $('.edit').on('click',function(){
        let url = "{{ route('student.edit',':id') }}";
        url = url.replace(':id',$(this).attr('data-id'));
        let edit = "{{ route('student.update',':id') }}";
        edit = edit.replace(':id',$(this).attr('data-id'));

        $.ajax({
            url:url,
            method:'get',
            success: function(data){
                $('#form').attr('action' , edit);
                $('#modalTitle').html('Edit Siswa');
                $('[name="_method"]').val('PUT');
                $('#nisn').attr('readonly',true);

                $('#nisn').val(data["nisn"]);
                $('#nis').val(data["nis"]);
                $('#name').val(data["name"]);
                $('#class_fk_id option[value='+data["class_fk_id"]+']').attr('selected','selected');
                $('#tuition_fk_id option[value='+data["tuition_fk_id"]+']').attr('selected','selected');
                $('#address').val(data["address"]);
                $('#phone').val(data["phone"]);
            }
        });
    })

    $('#modal').on('hide.bs.modal',function(){
        setTimeout(() => {
            $('#form').trigger('reset');
            $('#nisn').attr('readonly',false);

            // $('select[value=""]').attr('selected','selected');
            $('#form').attr('action' , '{{route("student.store")}}');
            $('#modalTitle').html('Tambah Siswa');
            $('[name="_method"]').val('POST');
        }, 500);
    });

    $('.receipt').on('click',function(){
        let url = "{{ route('student.show',':id') }}";
        url = url.replace(':id',$(this).attr('data-id'));

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
                
                $('#jumlahh').html('<b>Tanggal</b>');
                jQuery.each(data["payed"],function(i,val){
                    $('#rspp2').append('<div class="row justify-content-center align-items-center g-2"> <div class="col">'+val["month_name"]+' - '+val["year"]+'</div> <div class="col">'+val["treasurer"]+'</div> <div class="col">'+val["created_at"].slice(0,10)+'</div> <div class="col">1</div> <div class="col">'+val["price"]+'</div> </div>');
                });
                if(data["payed"].length == 0){
                    $('#rspp2').append('<div class="row justify-content-center align-items-center g-2"> <div class="col"></div> </div>');

                }

                var last = data["payed"][data["payed"].length-1];
                var first = data["payed"][0];
                $('#rspp').append('<div class="row justify-content-center align-items-center g-2"> <div class="col">'+first["month_name"]+' - '+first["year"]+' Sampai '+last["month_name"]+' - '+last["year"]+'</div> <div class="col">'+first["treasurer"]+'</div> <div class="col">'+data["payed"].length+'</div> <div class="col-2">'+first["price"]+'</div> </div>');
                $('#rspp').append('<hr><div class="row justify-content-center align-items-center g-2"> <div class="col-10"><b>Total:</b></div><div class="col-2"><b>'+data["payed"].length*first["price"]+'</b></div></div>');
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
