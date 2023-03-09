@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Kelas</h4>
                    <br>
                    <button type="button" class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#modal">
                        <i class="bi bi-plus"></i>Tambah Kelas
                    </button>
                    @include('classModal')
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
                                <th>Kelas</th>
                                <th>Jurusan</th>
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
                                    <td>{{$a->grade}}</td>
                                    <td>{{$a->major}}</td>
                                    <td><span style="display:none;">{{$a->created_at}}</span>
                                        <form action="{{route('class.destroy',$a->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" data-id="{{$a->id}}" class="edit btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modal">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button onclick="return confirm('Yakin ingin menghapus kelas {{$a->grade}} - {{$a->major}}?')" type="submit" class="btn btn-outline-danger">
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
{{-- @include('receipt') --}}
@endsection

@section('script')
<script>
    $('.edit').on('click',function(){
        let url = "{{ route('class.edit',':id') }}";
        url = url.replace(':id',$(this).attr('data-id'));
        let edit = "{{ route('class.update',':id') }}";
        edit = edit.replace(':id',$(this).attr('data-id'));

        $.ajax({
            url:url,
            method:'get',
            success: function(data){
                $('#form').attr('action' , edit);
                $('#modalTitle').html('Edit Kelas');
                $('[name="_method"]').val('PUT');

                $('#grade option[value='+data["grade"]+']').attr('selected','selected');
                $('#major').val(data["major"]);
            }
        });
    })

    $('#modal').on('hide.bs.modal',function(){
        setTimeout(() => {
            $('#form').trigger('reset');
            // $('select[value=""]').attr('selected','selected');
            $('#form').attr('action' , '{{route("class.store")}}');
            $('#modalTitle').html('Tambah Kelas');
            $('[name="_method"]').val('POST');
        }, 500);
    });
</script>
@endsection
