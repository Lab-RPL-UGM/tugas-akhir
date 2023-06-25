<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Daftar Dosen</h2>
                <div class="clearfix"></div>
            </div>
            <?php //var_dump($dataTable)
            ?><br><br>
            <?php //var_dump($nilai)
            ?>
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
            <!-- page content -->
            <div role="main">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Data Dosen<small></small></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>NID</th>
                                            <th>Nama</th>
                                            <th>No. HP</th>
                                            <th>Jmlh. Mahasiswa yang Dibimbing</th>
                                            <th>Partisipasi Pendadaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dataTable as $data) { ?>
                                            <tr>
                                                <td style="vertical-align:middle"><?php echo $data['nid']; ?></td>
                                                <td style="vertical-align:middle"><?php echo $data['nama_dosen']; ?></td>
                                                <td style="vertical-align:middle"><?php echo $data['mobile']; ?></td>
                                                <td style="vertical-align:middle">
                                                    <center>

                                                        <?php echo ($data['bimbingan'] != NULL ? '(' . $data['bimbingan'] . ' / ' . $data['kuota_mahasiswa'] . ')' : '<i>(Tidak ada data)</i>'); ?>
                                                        <a href="<?php echo base_url(); ?>akademik/daftar_dosen/bimbingan/<?php echo $data['id_dosen'] ?>" class="btn btn-primary btn-sm pull-right"><i class="fa fa-eye"></i></a>

                                                    </center>
                                                </td>
                                                <td style="vertical-align:middle"><?php echo $data['sidang']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->
        </div>
    </div>
</div>

<!-- /page content -->