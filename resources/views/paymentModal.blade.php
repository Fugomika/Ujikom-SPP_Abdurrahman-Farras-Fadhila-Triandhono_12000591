<form action="{{route('payment.store')}}" method="post" id="form">
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
                    <div class="col-3">
                        <div class="mb-3">
                            <select required class="form-select form-select-md" name="qty" id="qty">

                            </select>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="pricerp">Rp</span>
                            <input required readonly type="text"
                                class="form-control number" name="price" id="price" aria-describedby="pricerp" placeholder="Harga">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col-">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="totalrp">Rp</span>
                                <input required readonly type="text"
                                class="form-control number" name="total" id="total" aria-describedby="totalrp" placeholder="Total">
                            </div>
                            <small class="form-text text-muted" id="last"></small>
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