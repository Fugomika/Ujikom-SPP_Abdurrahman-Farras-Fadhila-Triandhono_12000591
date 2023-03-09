<form action="{{route('student.store')}}" method="post" id="form">
    @csrf
    <input type="hidden" name="_method" value="POST">
    <div class="modal fade" id="modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Siswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col">
                            <div class="mb-3">
                                <input required type="text"
                                class="form-control number" name="nisn" id="nisn" aria-describedby="helpId" placeholder="NISN">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <input required type="text"
                                    class="form-control number" name="nis" id="nis" aria-describedby="helpId" placeholder="NIS">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col">
                            <div class="mb-3">
                                <input required type="text"
                                class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Nama Lengkap">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col">
                            <div class="mb-3">
                                <select required class="form-select form-select-md" name="class_fk_id" id="class_fk_id">
                                    <option selected value="">Kelas</option>
                                    @foreach($c as $a)
                                        <option value="{{$a->id}}">{{$a->grade}} - {{$a->major}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <select required class="form-select form-select-md" name="tuition_fk_id" id="tuition_fk_id">
                                    <option selected value="">Tahun Masuk/Keluar</option>
                                    @foreach($t as $a)
                                        <option value="{{$a->id}}">{{$a->enter}}/{{$a->out}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col">
                            <div class="mb-3">
                                <input required type="text"
                                class="form-control" name="address" id="address" aria-describedby="helpId" placeholder="Alamat">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <input required type="text"
                                    class="form-control number" name="phone" id="phone" aria-describedby="helpId" placeholder="No. HP">
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