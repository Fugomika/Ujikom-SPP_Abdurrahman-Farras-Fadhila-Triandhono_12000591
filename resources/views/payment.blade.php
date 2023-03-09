@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Halaman Pembayaran</h4>
                    <br>
                    <button type="button" class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#modal">
                        <i class="bi bi-plus"></i>Tambah Pembayaran
                    </button>
                    @include('paymentModal')
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <strong>Berhasil!</strong> {{$message}}
                    </div>
                @endif
                @if ($message = Session::get('errors'))
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
                                <th>Name</th>
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
                                    <td>{{$a->nisn_fk_id}}</td>
                                    <td>{{$a->name}}</td>
                                    <td>{{$a->month_name}} - {{$a->year}}</td>
                                    <td>{{$a->treasurer}}</td>
                                    <td>{{$a->created_at}}</td>
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
    $('#nisn_fk_id').on('change',function(){
        let url = "{{ route('payment.create','nisn=:id') }}";
        url = url.replace(':id',$(this).val());

        $.ajax({
            url:url,
            method:'get',
            success: function(data){
                $('#price').val(data["student"]["price"]);
                $('#qty').find('option').remove();
                $('#qty').append('<option value="">x</option>');
                $('#last').html(data["last"]);

                for (let x = 1; x <= data["max"]; x++) {
                    $('#qty').append('<option value='+x+'>'+x+'x</option>');
                }

            }
        });
    })

    $('#qty').on('change',function(){
        $('#total').val($(this).val() * $('#price').val());
    })

    $('#modal').on('hide.bs.modal',function(){
        setTimeout(() => {
            $('#form').trigger('reset');
            // $('select[value=""]').attr('selected','selected');
            $('#form').attr('action' , '{{route("payment.store")}}');
            $('#modalTitle').html('Tambah Pembayaran');
            $('[name="_method"]').val('POST');
        }, 500);
    });

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

                $('#rspp').append('<div class="row justify-content-center align-items-center g-2"> <div class="col">'+data["payed"]["month_name"]+' - '+data["payed"]["year"]+'</div> <div class="col">'+data["payed"]["treasurer"]+'</div> <div class="col">'+data["payed"]["created_at"].slice(0,10)+'</div> <div class="col">1</div> <div class="col">Rp.'+data["payed"]["price"]+'</div> </div>');
                // jQuery.each(data["payed"][0],function(i,val){
                //     $('#rspp').append('<div class="row justify-content-center align-items-center g-2"> <div class="col">'+data["payed"]["month_name"]+'</div> <div class="col">'+data["payed"]["treasurer"]+'</div> <div class="col">'+data["payed"]["created_at"]+'</div> <div class="col">'+data["payed"]["price"]+'</div> </div>');
                // });
            }
        });
    })

    $('#modalReceipt').on('hide.bs.modal',function(){
        setTimeout(() => {
            console.log('ke hide ges')
                $('#rname').html();
                $('#rnisn').html();
                $('#rnis').html();
                $('#rclass').html();
                $('#ryear').html();
                $('#raddress').html();
                $('#rphone').html();
                $('#rspp').empty();
        }, 500);
    });
</script>
@endsection
