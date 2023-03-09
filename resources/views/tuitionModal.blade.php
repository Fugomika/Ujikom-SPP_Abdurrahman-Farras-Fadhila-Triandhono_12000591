<form action="{{route('tuition.store')}}" method="post" id="form">
@csrf
<input type="hidden" name="_method" value="POST">
<div class="modal fade" id="modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah SPP</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col">
                        <div class="mb-3">
                            <input required type="text"
                            class="form-control number" name="enter" id="enter" aria-describedby="helpId" placeholder="Tahun Masuk">
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <input required type="text"
                                class="form-control number" name="out" id="out" aria-describedby="helpId" placeholder="Tahun Masuk">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="pricerp">Rp</span>
                            <input required type="text"
                            class="form-control number" name="price" id="price" aria-describedby="pricerp" placeholder="Harga SPP">
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