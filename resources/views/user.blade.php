@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data User</h4>
                    <br>
                    <button type="button" class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#modal">
                        <i class="bi bi-plus"></i>Tambah User
                    </button>
                    @include('userModal')
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
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Level</th>
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
                                    <td>{{$a->name}}</td>
                                    <td>{{$a->email}}</td>
                                    <td>{{$a->level}}</td>
                                    <td><span style="display:none;">{{$a->created_at}}</span>
                                        <form action="{{route('user.destroy',$a->id)}}" method="post" id="form-delete">
                                            @csrf
                                            @method('delete')
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" data-id="{{$a->id}}" class="edit btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button type="button" data-id="Yakin ingin User {{$a->name}}?" class="delete btn btn-outline-danger">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </div>
                                        </form>
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
{{-- @include('receipt') --}}
@endsection

@section('script')
<script>
    $('.edit').on('click',function(){
        let url = "{{ route('user.edit',':id') }}";
        url = url.replace(':id',$(this).attr('data-id'));
        let edit = "{{ route('user.update',':id') }}";
        edit = edit.replace(':id',$(this).attr('data-id'));

        $.ajax({
            url:url,
            method:'get',
            success: function(data){
                $('#form').attr('action' , edit);
                $('#modalTitle').html('Edit User');
                $('[name="_method"]').val('PUT');

                $('#name').val(data["name"]);
                $('#level option[value='+data["level"]+']').attr('selected','selected');
                $('#email').val(data["email"]);
            }
        });
    })

    $('#modal').on('hide.bs.modal',function(){
        setTimeout(() => {
            $('#form').trigger('reset');
            // $('select[value=""]').attr('selected','selected');
            $('#form').attr('action' , '{{route("user.store")}}');
            $('#modalTitle').html('Tambah User');
            $('[name="_method"]').val('POST');
        }, 500);
    });
</script>
@endsection
