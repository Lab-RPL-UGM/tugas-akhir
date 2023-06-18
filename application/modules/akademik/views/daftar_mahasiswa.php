<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Daftar User Mahasiswa
                </h2>
                <div class="clearfix"></div>
            </div>
            <?php //var_dump($dataTable)?>
            <br>
            <br>
            <?php //var_dump($arrayAngkatan)?>
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
                        <div class="x_content">
                            <div style="margin-bottom:5%" class="col-md-4 col-sm-12 col-xs-12">
                                Saring berdasarkan angkatan:
                                <form action="<?php echo base_url(); ?>akademik/daftar_mahasiswa" method="get">
                                    <select style="margin-bottom:2%" name="angkatan" id="angkatan" class="form-control">
                                        <option value="all">Semua Angkatan</option>
                                    <?php foreach ($arrayAngkatan as $data) { ?>
                                        <?php if($pilihan) {?>
                                            <?php 
                                            $tahun = intval(substr(date('Y'),0,2))*100+intval($data->angkatan); 
                                            if($pilihan == $tahun){ ?>
                                                <option selected="selected" value="<?php echo $data->angkatan;?>"><?php echo $tahun?></option>
                                            <?php } else {?>
                                                <option value="<?php echo $data->angkatan;?>"><?php echo intval(substr(date('Y'),0,2))*100+intval($data->angkatan);?></option>
                                            <?php } ?>  
                                        <?php } else {?>
                                            <option value="<?php echo $data->angkatan;?>"><?php echo intval(substr(date('Y'),0,2))*100+intval($data->angkatan);?></option>
                                        <?php } ?>
                                    <?php } ?>
                                    </select>
                                    <input type="submit" class="btn btn-default" value="Filter"></input>
                                </form>
                            </div>
                            <div class="row col-md-12 col-sm-12 col-xs-12">
                                <a href="<?php echo base_url(); ?>akademik/daftar_mahasiswa/exportToExcel" class="btn btn-primary pull-right"><i class="fa fa-download"></i> Export to Excel</a>
                            </div>
                            <table id="tabel" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="col-md-2">NIM</th>
                                        <th class="col-md-3">Nama</th>
                                        <th class="col-md-2">No. HP</th>
                                        <th class="col-md-1">Judul</th>
                                        <th class="col-md-1">Sidang</th>
                                        <th class="col-md-1">Nilai Akhir</th>
                                        <th class="col-md-1">Yudisium</th>
                                        <th class="col-md-1">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataTable as $data) { ?>
                                    <tr>
                                        <td style="vertical-align:middle">
                                            <?php echo $data['nim']?>
                                        </td>
                                        <td style="vertical-align:middle">
                                            <?php echo $data['nama']?>
                                        </td>
                                        <td style="vertical-align:middle">
                                            <?php echo $data['no_hp']?>
                                        </td>
                                        <td align="center" style="vertical-align:middle">
                                            <?php if($data['judul']) {?>
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
                                            <?php if($data['sidang']) {?>
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
                                            <?php if($data['yudisium']) {?>
                                            <span class="badge bg-green">
                                                <i class="fa fa-check"></i>
                                            </span>
                                            <?php } else { ?>
                                            <span class="badge bg-warning">
                                                <i class="fa fa-minus"></i>
                                            </span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url(); ?>akademik/daftar_mahasiswa/detail_mahasiswa/<?php echo $data['id_mahasiswa']?>" class="btn btn-primary btn-sm">
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
</div>
<script>
$(function () {
    $('#tabel').DataTable({
        'paging' : true,
        'lengthChange' : true,
        'searching' : true,
        'ordering' : false,
        'info' : true,
        'autoWidth' :true
    })
})

</script>

<!-- /page content -->