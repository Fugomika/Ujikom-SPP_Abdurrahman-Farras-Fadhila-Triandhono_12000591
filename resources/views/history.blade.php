@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Data Siswa
                </div>
                <div class="card-body">
                            <h5>Siswa</h5>
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">Nama</div>
                            <div class="col" id="rname"></div>
                        </div>
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">NISN</div>
                            <div class="col" id="rnisn"></div>
                        </div>
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">NIS</div>
                            <div class="col" id="rnis"></div>
                        </div>
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">Kelas</div>
                            <div class="col" id="rclass"></div>
                        </div>
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">Tahun Masuk/Keluar</div>
                            <div class="col" id="ryear"></div>
                        </div>
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">Alamat</div>
                            <div class="col" id="raddress"></div>
                        </div>
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col">No. Handphone</div>
                            <div class="col" id="rphone"></div>
                        </div>
                </div>
                <div class="card-header">
                    <h4>Riyawat Pembayaran</h4>
                    <br>
                    <button type="button" data-id="" class="receipt2 btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalReceipt">
                        <i class="bi bi-eye"></i>
                    </button>

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
                                <th>Tahun Masuk</th>
                                <th>Tahun Keluar</th>
                                <th>Harga SPP</th>
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
                                    <td>{{$a->enter}}</td>
                                    <td>{{$a->out}}</td>
                                    <td>{{$a->price}}</td>
                                    <td><span style="display:none;">{{$a->created_at}}</span>
                                        <form action="{{route('tuition.destroy',$a->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" data-id="{{$a->id}}" class="edit btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button onclick="return confirm('Yakin ingin menghapus SPP {{$a->enter}}/{{$a->out}}?')" type="submit" class="btn btn-outline-danger">
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
        let url = "{{ route('tuition.edit',':id') }}";
        url = url.replace(':id',$(this).attr('data-id'));
        let edit = "{{ route('tuition.update',':id') }}";
        edit = edit.replace(':id',$(this).attr('data-id'));

        $.ajax({
            url:url,
            method:'get',
            success: function(data){
                $('#form').attr('action' , edit);
                $('#modalTitle').html('Edit SPP');
                $('[name="_method"]').val('PUT');

                $('#enter').val(data["enter"]);
                $('#out').val(data["out"]);
                $('#price').val(data["price"]);
            }
        });
    })

    $('#modal').on('hide.bs.modal',function(){
        setTimeout(() => {
            $('#form').trigger('reset');
            // $('select[value=""]').attr('selected','selected');
            $('#form').attr('action' , '{{route("tuition.store")}}');
            $('#modalTitle').html('Tambah SPP');
            $('[name="_method"]').val('POST');
        }, 500);
    });
</script>
@endsection
