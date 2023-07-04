<!-- page content -->
<div role="main" style="height: 100vh;">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Dashboard</h3>
            </div>
            <?php //var_dump($dataNilaiAkhirSidang); 
            ?>
            <?php //var_dump($dataNilai); 
            ?>
        </div>
        <div class="clearfix"></div>
        <br>
        <center>
            <p>
                <?php if ($dataPeriode) { ?>
            <h3>Periode Semester
                <span>
                    <strong>
                        <?php echo ucfirst($dataPeriode[0]->semester) . " " . $dataPeriode[0]->tahun_ajaran; ?>
                    </strong>
                </span>
            </h3>
        <?php } else {
                    echo "<h3><strong><i>(Belum ada periode yang aktif)</i></strong></h3>";
                } ?>
        </p>
        <p>
            <i>
                <?php echo DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->format('j F Y'); ?>
            </i>
        </p>
        </center>
        <div class="row top_tiles">
            <div class="animated flipInY col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon">
                        <i class="fa fa-tasks"></i>
                    </div>
                    <div class="count">
                        <?php echo $countProyek ?>
                    </div>
                    <h3>Judul Proyek</h3>
                    <p>
                        <a href="<?php echo base_url(); ?>akademik/proyek">Cek List Judul Proyek
                            <i class="fa fa-arrow-right"></i>
                        </a>
                    </p>
                </div>
            </div>
            <div class="animated flipInY col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="count">
                        <?php echo $countSidang ?>
                    </div>
                    <h3>Sidang</h3>
                    <p>
                        <a href="<?php echo base_url(); ?>akademik/sidang">Cek List Sidang</a>
                        <i class="fa fa-arrow-right"></i>
                    </p>
                </div>
            </div>
            <div class="animated flipInY col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="icon">
                        <i class="fa fa-graduation-cap"></i>
                    </div>
                    <div class="count">
                        <?php echo $countYudisium ?>
                    </div>
                    <h3>Yudisium</h3>
                    <p>
                        <a href="<?php echo base_url(); ?>akademik/yudisium">Cek List Yudisium</a>
                        <i class="fa fa-arrow-right"></i>
                    </p>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <h4>
                                <strong>Diagram Lingkaran Penilaian Sidang per Periode</strong>
                            </h4>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <select name="select_periode" id="select_periode" class="form-control pull-right">
                                <?php if ($arrayPeriode) { ?>
                                    <?php foreach ($arrayPeriode as $periode) { ?>
                                        <?php if (end($arrayPeriode) == $periode) { ?>
                                            <option selected="selected" value="<?php echo $periode['id_periode']; ?>"><?php echo $periode['nama_periode'] ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $periode['id_periode']; ?>"><?php echo $periode['nama_periode'] ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } else { ?>
                                    <option value="0">No Data</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div id="diagram_lingkaran" style="height:400px;width:100%;position:relative;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h3>
                            <strong>Grafik Rata-rata Penilaian Sidang per Periode (maks. 5 Periode)</strong>
                        </h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div id="diagram" style="height:600px;width:100%;position:relative;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
</div>
<!-- /page content -->
<script>


</script>
<script>
    var dataNilai = <?php echo $dataNilai; ?>;
    var baseURL = '<?php echo base_url(); ?>';
</script>
<!-- <script src="<?php echo base_url() ?>elusistatic/js/grafikPenilaian.js"></script> -->