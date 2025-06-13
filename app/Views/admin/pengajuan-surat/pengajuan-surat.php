<?= $this->extend('komponen/template-real-admin') ?>

<?= $this->section('content') ?>

<div class="x_panel">
    <div class="x_title">
        <h2>Data Surat <small>Surat yang Sedang Diajukan</small></h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Settings 1</a>
                    <a class="dropdown-item" href="#">Settings 2</a>
                </div>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php elseif (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <p class="text-muted font-13 m-b-30">
                        Berikut adalah daftar surat yang sedang diajukan.
                    </p>
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Surat</th>
                                <th>Jenis Surat</th>
                                <th>Tanggal Dibuat</th>
                                <th>Status Surat</th> <!-- Tambahan -->
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($dataSurat as $s): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $s['no_surat'] ?></td>
                                    <td><?= $s['jenis_surat'] ?></td>
                                    <td><?= date('d-m-Y', strtotime($s['created_at'])) ?></td>
                                    <td>
                                        <?php
                                        switch (strtolower($s['status_surat'])) {
                                            case 'diajukan':
                                                echo '<span class="badge badge-primary">Diajukan</span>';
                                                break;
                                            case 'proses':
                                                echo '<span class="badge badge-info">Proses</span>';
                                                break;
                                            case 'revisi':
                                                echo '<span class="badge badge-warning">Revisi</span>';
                                                break;
                                            case 'batal':
                                                echo '<span class="badge badge-danger">Batal</span>';
                                                break;
                                            case 'selesai':
                                                echo '<span class="badge badge-success">Selesai</span>';
                                                break;
                                            default:
                                                echo '<span class="badge badge-secondary">' . esc($s['status_surat']) . '</span>';
                                        }
                                        ?>
                                    </td>

                                    <td>
                                        <a href="<?= base_url('masyarakat/data-surat/' . $s['jenis_surat'] . '/download/' . $s['id_surat']) ?>" class="btn btn-sm btn-success">
                                            <i class="fa fa-download"></i> Download
                                        </a>

                                        <!-- Tombol untuk membuka modal -->
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalKirim<?= $s['id_surat'] ?>">
                                            <i class="fa fa-paper-plane"></i> Kirim
                                        </button>
                                    </td>

                                    <!-- Modal Kirim Surat -->
                                    <div class="modal fade" id="modalKirim<?= $s['id_surat'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalKirimLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="<?= base_url('admin/kirim-surat/' . $s['id_surat']) ?>" method="post" enctype="multipart/form-data">
                                                <?= csrf_field() ?>
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Kirim Surat ke Pemohon</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="file_surat">Unggah Surat dengan Nomer Surat <?= $s['no_surat'] ?> yang Telah Ditandatangani</label>
                                                            
                                                            <input type="file" class="form-control" name="file_surat" required>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Kirim</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>



                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Batal Ajukan -->
<div class="modal fade" id="modalBatalAjukan" tabindex="-1" role="dialog" aria-labelledby="modalBatalAjukanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalBatalAjukanLabel">Konfirmasi Pembatalan</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin membatalkan pengajuan surat ini? Surat ini akan dihapus dari daftar surat yang sedang diajukan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a id="btnConfirmBatal" href="#" class="btn btn-danger">Ya, Batalkan</a>
            </div>
        </div>
    </div>
</div>

<!-- Script untuk set id surat yang akan dibatalkan -->
<script>
    function setBatalId(id) {
        document.getElementById('btnConfirmBatal').href = '<?= base_url("masyarakat/data-surat/batal/") ?>' + id;
    }
</script>

<?= $this->endSection() ?>