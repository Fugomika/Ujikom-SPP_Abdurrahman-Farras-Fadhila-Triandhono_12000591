<form action="{{route('mutation.store')}}" method="post" id="form">
@csrf
<input type="hidden" name="_method" value="POST">
<div class="modal fade" id="modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Mutasi / Tidak Naik Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col">
                        <div class="mb-3">
                            <select required class="form-select form-select-md select2" name="nisn_fk_id" id="nisn_fk_id">
                                <option selected value="">Siswa</option>
                                @foreach($s as $a)
                                    <option value="{{$a->nisn}}">{{$a->nisn}} - {{$a->name}}</option>
                                @endforeach
                            </select>                        
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col">
                        <div class="mb-3">
                            <select required class="form-select form-select-md" name="reduction" id="reduction">
                                <option selected value="">Penambahan / Pengurangan Tahun</option>
                                <option value="24">+2 Tahun (Mutasi)</option>
                                <option value="12">+1 Tahun (Mutasi)</option>
                                <option value="-12">-1 Tahun (Tidak Naik Kelas)</option>
                                <option value="-24">-2 Tahun (Tidak Naik Kelas)</option>
                                <option value="-24">-3 Tahun (Tidak Naik Kelas)</option>
                                <option value="-36">-4 Tahun (Tidak Naik Kelas)</option>
                            </select>                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" onclick="return confirm('Yakin data sudah benar?')"class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
</form>