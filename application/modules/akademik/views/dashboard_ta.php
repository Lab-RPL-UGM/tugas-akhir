<div role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Persetujuan Tugas Akhir</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <!--tabel ta mahasiswa-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php
                $this->load->helper('form');
                $error = $this->session->flashdata('error');
                if ($error) {
                ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>
                <?php
                $success = $this->session->flashdata('success');
                if ($success) {
                ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Mahasiswa Mengajukan
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="tabel" class="table table-striped table-bordered dt-responsive">
                            <thead>
                                <tr style="vertical-align:middle">
                                    <th class="col-md-2" style="vertical-align:middle">
                                        <center>NIM</center>
                                    </th>
                                    <th class="col-md-2" style="vertical-align:middle">
                                        <center>Nama</center>
                                    </th>
                                    <th class="col-md-1" style="vertical-align:middle">
                                        <center>Semester</center>
                                    </th>
                                    <th class="col-md-1" style="vertical-align:middle">
                                        <center>Tahun Ajaran</center>
                                    </th>
                                    <th class="col-md-1" style="vertical-align:middle">
                                        <center>Tanggal Mengajukan</center>
                                    </th>
                                    <th class="col-md-1" style="vertical-align:middle">
                                        <center>Terakhir Diperbarui</center>
                                    </th>
                                    <th class="col-md-1" style="vertical-align:middle">
                                        <center>Progress Bimbingan</center>
                                    </th>
                                    <th class="col-md-1" style="vertical-align:middle">
                                        <center>Status Penerimaan</center>
                                    </th>
                                    <th class="col-md-1" style="vertical-align:middle">
                                        <center>Aksi</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataTable as $data) { ?>
                                    <tr>
                                        <td style="vertical-align:middle">
                                            <?php echo $data->nim; ?>
                                        </td>
                                        <td style="vertical-align:middle">
                                            <?php echo $data->nama; ?>
                                        </td>
                                        <td style="vertical-align:middle">
                                            <?php echo $data->semester; ?>
                                        </td>
                                        <td style="vertical-align:middle">
                                            <?php echo $data->tahun_ajaran; ?>
                                        </td>
                                        <td style="vertical-align:middle">
                                            <?php echo date('d M Y', strtotime($data->tanggal_mengajukan)); ?>
                                        </td>
                                        <td style="vertical-align:middle">
                                            <?php
                                            // updatedDtm default-nya '0000-00-00 00:00:00' (belum pernah ke-update
                                            // sejak dibuat) -- kalau langsung di-strtotime jadi tanggal ngaco
                                            // ("30 Nov -0001"). Baris yang belum pernah diperbarui berarti
                                            // keadaannya masih sama seperti saat diajukan.
                                            $tglUpdate = ($data->tanggal_update && $data->tanggal_update !== '0000-00-00 00:00:00')
                                                ? $data->tanggal_update
                                                : $data->tanggal_mengajukan;
                                            echo date('d M Y H:i', strtotime($tglUpdate));
                                            ?>
                                        </td>
                                        <td style="vertical-align:middle">
                                            <?php echo $data->progress; ?>
                                        </td>
                                        <td align="center" style="vertical-align:middle">
                                            <?php if ($data->status_pengambilan == 'revisi') { ?>
                                                <span class="label label-danger">Revisi</span>
                                            <?php } elseif ($data->status_pengambilan == 'proses') { ?>
                                                <span class="label label-warning">Proses</span>
                                            <?php } else { ?>
                                                <span class="label label-default">Nonaktif</span>
                                            <?php } ?>
                                        </td>
                                        <?php if ($data->status_pengambilan == 'revisi') { ?>
                                            <td align="center" style="vertical-align:middle">
                                                <a data-toggle="tooltip" title="Detail" href="<?php echo base_url(); ?>akademik/tugas_akhir/plotting/<?php echo $data->id_ta; ?>" class="btn btn-primary">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        <?php } elseif ($data->status_pengambilan == 'proses') { ?>
                                            <td align="center" style="vertical-align:middle">
                                                <a data-toggle="tooltip" title="Detail" href="<?php echo base_url(); ?>akademik/tugas_akhir/plotting/<?php echo $data->id_ta; ?>" class="btn btn-primary">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            </td>
                                        <?php } else { ?>
                                            <td align="center" style="vertical-align:middle">
                                                <a data-toggle="tooltip" title="Edit" href="<?php echo base_url(); ?>akademik/tugas_akhir/detail/<?php echo $data->id_ta; ?>" class="btn btn-primary">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            </td>
                                        <?php } ?>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <!--modal-->
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">Pesan Revisi</h4>
                                    </div>
                                    <div class="modal-body">
                                        <textarea id="" class="col-md-12" rows="5"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button style="margin-top: 2%" type="button" class="btn btn-primary">Kirim</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--tabel mahasiswa yang sudah di-ACC / terplotting-->
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Mahasiswa Sudah Di-ACC (Terplotting)
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="tabelAcc" class="table table-striped table-bordered dt-responsive">
                            <thead>
                                <tr style="vertical-align:middle">
                                    <th class="col-md-2" style="vertical-align:middle">
                                        <center>NIM</center>
                                    </th>
                                    <th class="col-md-2" style="vertical-align:middle">
                                        <center>Nama</center>
                                    </th>
                                    <th class="col-md-1" style="vertical-align:middle">
                                        <center>Semester</center>
                                    </th>
                                    <th class="col-md-1" style="vertical-align:middle">
                                        <center>Tahun Ajaran</center>
                                    </th>
                                    <th class="col-md-1" style="vertical-align:middle">
                                        <center>Tanggal Mengajukan</center>
                                    </th>
                                    <th class="col-md-1" style="vertical-align:middle">
                                        <center>Terakhir Diperbarui</center>
                                    </th>
                                    <th class="col-md-1" style="vertical-align:middle">
                                        <center>Progress Bimbingan</center>
                                    </th>
                                    <th class="col-md-1" style="vertical-align:middle">
                                        <center>Status Penerimaan</center>
                                    </th>
                                    <th class="col-md-1" style="vertical-align:middle">
                                        <center>Aksi</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataTableAcc as $data) { ?>
                                    <tr>
                                        <td style="vertical-align:middle">
                                            <?php echo $data->nim; ?>
                                        </td>
                                        <td style="vertical-align:middle">
                                            <?php echo $data->nama; ?>
                                        </td>
                                        <td style="vertical-align:middle">
                                            <?php echo $data->semester; ?>
                                        </td>
                                        <td style="vertical-align:middle">
                                            <?php echo $data->tahun_ajaran; ?>
                                        </td>
                                        <td style="vertical-align:middle">
                                            <?php echo date('d M Y', strtotime($data->tanggal_mengajukan)); ?>
                                        </td>
                                        <td style="vertical-align:middle">
                                            <?php
                                            $tglUpdateAcc = ($data->tanggal_update && $data->tanggal_update !== '0000-00-00 00:00:00')
                                                ? $data->tanggal_update
                                                : $data->tanggal_mengajukan;
                                            echo date('d M Y H:i', strtotime($tglUpdateAcc));
                                            ?>
                                        </td>
                                        <td style="vertical-align:middle">
                                            <?php echo $data->progress; ?>
                                        </td>
                                        <td align="center" style="vertical-align:middle">
                                            <span class="label label-success">Terplotting Bimbingan</span>
                                        </td>
                                        <td align="center" style="vertical-align:middle">
                                            <a data-toggle="tooltip" title="Lihat" href="<?php echo base_url(); ?>akademik/tugas_akhir/detail/<?php echo $data->id_ta; ?>" class="btn btn-primary">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#tabel').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': false,
            // 'ordering:false' cuma matiin UI klik-buat-sort -- DataTables tetap diam²
            // pakai default "order: [[0,'asc']]" (kolom NIM) kalau tidak di-override,
            // jadi urutan tanggal_update DESC dari server ke-timpa jadi urutan NIM.
            'order': [],
            'info': true,
            'autoWidth': true
        })
        $('#tabelAcc').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': false,
            'order': [],
            'info': true,
            'autoWidth': true
        })
    })
</script>