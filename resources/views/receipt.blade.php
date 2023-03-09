<div class="modal fade" id="modalReceipt" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" id="section-to-print">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Riwayat Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Siswa</h5>
                <hr>
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col">Nama Lengkap</div>
                    <div id="rname" class="col"></div>
                </div>
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col">NISN</div>
                    <div id="rnisn" class="col"></div>
                </div>
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col">NIS</div>
                    <div id="rnis" class="col"></div>
                </div>
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col">Kelas</div>
                    <div id="rclass" class="col"></div>
                </div>
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col">Tahun Masuk/Keluar</div>
                    <div id="ryear" class="col"></div>
                </div>
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col">Alamat</div>
                    <div id="raddress" class="col"></div>
                </div>
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col">Nomor Handphone</div>
                    <div id="rphone" class="col"></div>
                </div>
                <hr>
                <h5>Sudah Membayar SPP Untuk</h5>
                <hr>
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col"><b>Bulan</b></div>
                    <div class="col"><b>Petugas</b></div>
                    {{-- <div class="col"><b>Detail</b></div> --}}
                    <div class="col" id="jumlahh"><b>Jumlah</b></div>
                    <div class="col"><b>Harga</b></div>
                </div>
                <div id="rspp">

                </div>

                <div id="hide" style='display:none;'>
                    <hr>
                    <h5>Detail</h5>
                    <hr>
                    <div class="row justify-content-center align-items-center g-2">
                        <div class="col"><b>Bulan</b></div>
                        <div class="col"><b>Petugas</b></div>
                        <div class="col"><b>Pada</b></div>
                        <div class="col"><b>Jumlah</b></div>
                        <div class="col"><b>Harga</b></div>
                    </div>
                    <div id="rspp2">

                    </div>
                </div>

                <hr>
                <div class="row justify-content-center align-items-center g-2">
                    <div class="col"><b>{{Carbon\Carbon::now()}}</b></div>
                    <div class="col"><b>{{auth()->user()->name}}</b></div>
                </div>
            </div>
            <div class="modal-footer" id="receiptFooter">
                <button type="button" onclick="window.print()" class="btn btn-warning"><i class="bi bi-printer-fill"></i></button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>