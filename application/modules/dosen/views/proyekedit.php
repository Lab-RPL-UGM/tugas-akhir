<?php
/**
 * Created by nad.
 * Date: 22/03/2018
 * Time: 21:12
 * Description:
 */
?>
<?php
$id_dosen = '';
$nama = '';

if(!empty($dosenInfo))
{
    foreach ($dosenInfo as $uf)
    {
        $id_mahasiswa = $uf->id_dosen;
        $nama = $uf->nama;
    }
}
?>
<?php
$id_proyek = '';
$nama_proyek = '';
$nama_dosen = '';
$klien = '';

if(!empty($proyekInfo))
{
    foreach ($proyekInfo as $uf)
    {
        $id_proyek = $uf->id_proyek;
        $nama_proyek = $uf->nama_proyek;
        $nama_dosen = $uf->nama_dosen;
        $klien = $uf->klien;
    }
}
//var_dump($proyekInfo);
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><a href="<?php echo base_url()?>dosen/proyek"><i class="fa fa-chevron-left"></i></a> Project Management <small>Add, Edit</small></h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h4>Detail Proyek</h4>
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
                    <br />
                    <form id="edit-proyek" action="<?php echo base_url()?>dosen/proyek/editProject" method="post" role="form" data-parsley-validate class="form-horizontal form-label-left">
                        <div class="form-group">
                            <input type="hidden" name="id-proyek" id="id-proyek" class="form-control col-md-7 col-xs-12" value="<?php echo $id_proyek?>">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama-dosen">Penanggung jawab<span class="required"> *</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12" id="nama-dosen" name="id_dosen">
                                    <?php
                                    if(!empty($dosenInfo))
                                    {
                                        foreach ($dosenInfo as $dosen)
                                        {
                                            ?>
                                            <option value="<?php echo $dosen->id_dosen?>" <?php echo ($dosen->id_dosen == $id_dosen) ? "selected=\"selected\"" : ""; ?>><?php echo $dosen->nama ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama-proyek">Nama Proyek <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nama-proyek" id="nama-proyek" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $nama_proyek?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="instansi" class="control-label col-md-3 col-sm-3 col-xs-12">Instansi <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input required="required" id="klien" class="form-control col-md-7 col-xs-12" type="text" name="klien" value="<?php echo $klien?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 pull-right">
                                <a href="<?php echo base_url()?>dosen/proyek" class="btn btn-danger">Cancel</a>
                                <input type="submit" class="btn btn-success" value="Submit" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
