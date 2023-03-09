<form action="{{route('user.store')}}" method="post" id="form">
@csrf
<input type="hidden" name="_method" value="POST">
<div class="modal fade" id="modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col">
                        <div class="mb-3">
                            <input required type="email"
                            class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Email">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <input required type="text"
                            class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Nama">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col">
                        <div class="mb-3">
                            <input required type="password"
                                class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <select required class="form-select form-select-md" name="level" id="level">
                                <option selected value="">Level</option>
                                <option value="treasurer">Petugas</option>
                                <option disabled value="student">Siswa - Silahkan buat dalam halaman siswa</option>
                            </select>                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
</form>