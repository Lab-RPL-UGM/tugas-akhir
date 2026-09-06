<?php
/**
 * Created by nad.
 * Date: 22/03/2018
 * Time: 22:26
 * Description:
 */
//var_dump($proyekInfo)
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Project Management</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <!--berkas mahasiswa-->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Daftar Seluruh Proyek<small></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            $this->load->helper('form');
                            $error = $this->session->flashdata('error');
                            if($error)
                            {
                                ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php echo $this->session->flashdata('error'); ?>
                                </div>
                            <?php } ?>
                            <?php
                            $success = $this->session->flashdata('success');
                            if($success)
                            {
                                ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php } ?>

                            <div class="row">
                                <div class="col-md-12">
                                    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url()?>dosen/proyek/addNew" class="btn btn-success pull-right">Add New Project</a>
                    <table id="tabelProyekDosen" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Tanggal Pengajuan</th>
                            <th>Judul Proyek</th>
                            <th>Instansi</th>
                            <th>Status Pengajuan</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(!empty($proyekInfo))
                            {
                            foreach($proyekInfo as $record)
                            {
                        ?>
                        <tr>
                            <td data-order="<?php echo strtotime($record->createdDtm); ?>"><?php echo date('d-m-Y H:i', strtotime($record->createdDtm)); ?></td>
                            <td><?php echo $record->nama_proyek ?></td>
                            <td><?php echo $record->klien ?></td>

                            <?php if ($record->status == 'disetujui') {
                                echo "<td><span class=\"label label-success\">Usulan Diterima</span></td>";
                            } elseif ($record->status == 'pending') {
                                echo "<td><span class=\"label label-warning\">Menunggu Persetujuan</span></td>";
                            } else {
                                echo "<td><span class=\"label label-danger\">Usulan Ditolak</span></td>";
                            }
                            ?>
                            <td>
                                <?php if ($record->status != 'pending') { ?>
                                    <a href="<?php echo base_url() ?>dosen/proyek/pendaftar/<?php echo $record->id_proyek?>" class="btn btn-default" title="Lihat mahasiswa yang memilih proyek ini">
                                        <i class="fa fa-users"></i> <?php echo (int)($record->jumlah_pendaftar ?? 0); ?>
                                    </a>
                                <?php } ?>
                                <?php if ($record->status == 'pending') { ?>
                                    <a href="<?php echo base_url() ?>dosen/proyek/editOld/<?php echo $record->id_proyek?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                <?php } else { ?>
                                    <a href="javascript:;" class="btn btn-default btn-lihat-proyek"
                                       data-judul="<?php echo htmlspecialchars($record->nama_proyek, ENT_QUOTES); ?>"
                                       data-klien="<?php echo htmlspecialchars($record->klien ?: '(tidak ada)', ENT_QUOTES); ?>"
                                       data-deskripsi="<?php echo htmlspecialchars($record->deskripsi ?: '(tidak ada)', ENT_QUOTES); ?>"
                                       data-tools="<?php echo htmlspecialchars($record->tools ?: '(tidak ada)', ENT_QUOTES); ?>"
                                       data-bidang="<?php echo htmlspecialchars($record->nama_bidang ?: '(tidak ada)', ENT_QUOTES); ?>"
                                       data-periode="<?php echo htmlspecialchars(!empty($record->semester) ? ucfirst($record->semester) . ' ' . $record->tahun_ajaran : '(belum diklasifikasikan)', ENT_QUOTES); ?>"
                                       data-status="<?php echo $record->status == 'disetujui' ? 'Usulan Diterima' : 'Usulan Ditolak'; ?>"
                                       data-status-class="<?php echo $record->status == 'disetujui' ? 'label-success' : 'label-danger'; ?>"
                                       title="Lihat detail proyek (tidak bisa diedit)">
                                        <i class="fa fa-eye"></i> Lihat
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>
                                <?php
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal detail proyek (read-only) -- dipakai bersama semua baris yang statusnya
     sudah diproses (tidak bisa diedit lagi), diisi via JS pas tombol "Lihat" diklik. -->
<div class="modal fade" id="viewProyekModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content detail-proyek-modal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="detail-proyek-heading">
                    <h4 class="modal-title" id="vp-judul"></h4>
                    <span class="label" id="vp-status"></span>
                </div>
            </div>
            <div class="modal-body">
                <div class="detail-proyek-grid">
                    <div class="detail-field">
                        <span class="detail-field-label">Instansi</span>
                        <span class="detail-field-value" id="vp-klien"></span>
                    </div>
                    <div class="detail-field">
                        <span class="detail-field-label">Periode</span>
                        <span class="detail-field-value" id="vp-periode"></span>
                    </div>
                </div>
                <div class="detail-field">
                    <span class="detail-field-label">Bidang</span>
                    <span class="detail-field-value" id="vp-bidang"></span>
                </div>
                <div class="detail-field">
                    <span class="detail-field-label">Deskripsi</span>
                    <p class="detail-field-value" id="vp-deskripsi"></p>
                </div>
                <div class="detail-field">
                    <span class="detail-field-label">Tools</span>
                    <span class="detail-field-value" id="vp-tools"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.btn-lihat-proyek', function () {
        $('#vp-judul').text($(this).data('judul'));
        $('#vp-status').text($(this).data('status')).attr('class', 'label ' + $(this).data('status-class'));
        $('#vp-klien').text($(this).data('klien'));
        $('#vp-bidang').text($(this).data('bidang'));
        $('#vp-periode').text($(this).data('periode'));
        $('#vp-deskripsi').text($(this).data('deskripsi'));
        $('#vp-tools').text($(this).data('tools'));
        $('#viewProyekModal').modal('show');
    });

    $(function () {
        // ID tabel ini sengaja bukan "datatable" -- ada init global di custom.js
        // ($('#datatable').dataTable();) yang otomatis pakai default DataTables
        // (urut kolom pertama ascending), yang menimpa ORDER BY DESC dari server.
        // Inisialisasi sendiri di sini supaya urutan "terbaru dulu" beneran dipakai.
        $('#tabelProyekDosen').DataTable({
            order: [[0, 'desc']]
        });
    });
</script>