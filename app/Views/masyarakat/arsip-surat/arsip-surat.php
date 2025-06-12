<?= $this->extend('komponen/template-admin') ?>

<?= $this->section('content') ?>

<div class="x_panel">
    <div class="x_title">
        <h2>Arsip Surat <small>Surat yang Telah Diproses</small></h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                </div>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <p class="text-muted font-13 m-b-30">
                        Berikut adalah arsip surat yang telah diproses.
                    </p>
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Surat</th>
                                <th>Jenis Surat</th>
                                <th>Tanggal Dibuat</th>
                                <th>Status Surat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($dataSurat as $s): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $s['no_surat'] ?></td>
                                    <td><?= $s['jenis_surat'] ?></td>
                                    <td><?= date('d-m-Y H:i', strtotime($s['created_at'])) ?></td>
                                    <td>
                                        <?php
                                        switch (strtolower($s['status_surat'])) {
                                            case 'selesai':
                                                echo '<span class="badge badge-success">Selesai</span>';
                                                break;
                                            case 'ditolak':
                                                echo '<span class="badge badge-danger">Ditolak</span>';
                                                break;
                                            default:
                                                echo '<span class="badge badge-secondary">' . esc($s['status_surat']) . '</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('masyarakat/arsip-surat/selesai/download/' . $s['id_surat']) ?>" class="btn btn-sm btn-success">
                                            <i class="fa fa-download"></i> Download
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>