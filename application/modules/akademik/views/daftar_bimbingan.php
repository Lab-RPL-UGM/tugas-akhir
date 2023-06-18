<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4>
                    <a href="<?php echo base_url() ;?>akademik/daftar_dosen">
                        <i class="fa fa-chevron-left"></i>
                    </a> &nbsp;Daftar Bimbingan
                </h4>
                <div class="clearfix"></div>
            </div>
            <?php //var_dump($dataMahasiswa)?><br><br>
            <?php //var_dump($nilai)?>
            <div class="col-md-12 col-sm-12 col-xs-12">
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
            </div>
            <div role="main">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Data Mahasiswa yang Dibimbing</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Project/Judul</th>
                                            <th>Judul</th>
                                            <th>Sidang</th>
                                            <th>Nilai Akhir</th>
                                            <th>Yudisium</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dataMahasiswa as $data) { ?>
                                            <tr>
                                                <td style="vertical-align:middle"><?php echo $data['nim']?></td>
                                                <td style="vertical-align:middle"><?php echo $data['nama']?></td>
                                                <td style="vertical-align:middle"><?php echo $data['judul']?></td>
                                                <td align="center" style="vertical-align:middle">
                                                    <?php if($data['isJudul']) {?>
                                                        <span class="badge bg-green">
                                                            <i class="fa fa-check"></i>
                                                        </span>
                                                    <?php } else { ?>
                                                        <span class="badge bg-warning">
                                                            <i class="fa fa-minus"></i>
                                                        </span>
                                                    <?php } ?>
                                                </td>
                                                <td align="center" style="vertical-align:middle">
                                                    <?php if($data['isSidang']) {?>
                                                        <span class="badge bg-green">
                                                            <i class="fa fa-check"></i>
                                                        </span>
                                                    <?php } else { ?>
                                                        <span class="badge bg-warning">
                                                            <i class="fa fa-minus"></i>
                                                        </span>
                                                    <?php } ?>
                                                </td>
                                                <td align="center" style="vertical-align:middle">
                                                    <?php if($data['nilai_akhir'] != FALSE || $data['nilai_akhir'] != 0 ) {
                                                            echo $data['nilai_akhir']; 
                                                          } else {
                                                            echo "-";
                                                          }
                                                    ?>
                                                </td>
                                                <td align="center" style="vertical-align:middle">
                                                    <?php if($data['isYudisium']) {?>
                                                        <span class="badge bg-green">
                                                            <i class="fa fa-check"></i>
                                                        </span>
                                                    <?php } else { ?>
                                                        <span class="badge bg-warning">
                                                            <i class="fa fa-minus"></i>
                                                        </span>
                                                    <?php } ?>
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
    </div>
</div>

<!-- /page content -->