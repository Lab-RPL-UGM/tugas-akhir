<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>User
                <small>Add</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php //var_dump($role);
            ?>
            <div class="x_panel">
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
                <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" id="addEditUserForm" action="<?php echo base_url() . 'akademik/user/add_user/' . $role ?>" method="post">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Lengkap
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="hidden" value="" name="userId" id="userId" />
                                <input id="fname" type="text" name="fname" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <?php if ($role == ROLE_MAHASISWA) { ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">NIM
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="nim" type="text" name="nim" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email UGM
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="email" type="email" name="email" required="required" placeholder="nama@mail.ugm.ac.id" class="form-control col-md-7 col-xs-12">
                                    <small>Email ini yang dipakai untuk mencocokkan login SSO — harus sama dengan akun Google/UGM mahasiswa.</small>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($role == ROLE_DOSEN || $role == ROLE_KAPRODI) { ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Gelar Depan
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="gelar_depan" type="text" name="gelar_depan" required="required" placeholder="Drs." class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Gelar Belakang
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="gelar_belakang" type="text" name="gelar_belakang" required="required" placeholder="S.Kom, M.Kom" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">NIP/NIKA
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="nid" type="text" name="nid" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Kuota Maksimal Mahasiswa
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="kuota_mahasiswa" type="number" name="kuota_mahasiswa" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($role != ROLE_MAHASISWA) { ?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Username
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="username" type="text" name="username" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Password
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="password" type="password" name="password" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password
                                <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="cpassword" type="password" name="cpassword" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <?php if ($role == ROLE_MAHASISWA) { ?>
                                    <a href="<?php echo base_url() . 'akademik/akun_mahasiswa/' ?>" class="btn btn-danger">Cancel</a>
                                <?php } ?>
                                <?php if ($role == ROLE_DOSEN) { ?>
                                    <a href="<?php echo base_url() . 'akademik/akun_dosen/' ?>" class="btn btn-danger">Cancel</a>
                                <?php } ?>
                                <?php if ($role == ROLE_KAPRODI) { ?>
                                    <a href="<?php echo base_url() . 'akademik/akun_kaprodi/' ?>" class="btn btn-danger">Cancel</a>
                                <?php } ?>
                                <?php if ($role == ROLE_AKADEMIK) { ?>
                                    <a href="<?php echo base_url() . 'akademik/akun_akademik/' ?>" class="btn btn-danger">Cancel</a>
                                <?php } ?>
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>

                        </div>
                    </form>
                    <?php if ($role != ROLE_KAPRODI) { ?>
                        <center>
                            <h5>- - ATAU - -</h5>
                        </center>

                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <br>
                            <div class="form-group">
                                <center>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label>Upload Data dengan file (.xlsx)</label>
                                        <br>
                                        <?php if ($role == ROLE_MAHASISWA) { ?>
                                            <img class="col-md-12 col-sm-12 col-xs-12" style="border:1px solid black;" src="<?php echo base_url(); ?>elusistatic/images/excel_rule.png">
                                        <?php } elseif ($role == ROLE_DOSEN) { ?>
                                            <img class="col-md-12 col-sm-12 col-xs-12" style="border:1px solid black;" src="<?php echo base_url(); ?>elusistatic/images/excel_dosen.png">
                                        <?php }  ?>
                                    </div>
                                </center>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <ul>
                                    <li>
                                        <strong>Pastikan <u>judul kolom</u> yang ada di file (.xlsx)/(.xls) berada di baris paling atas / pertama</strong>
                                    </li>
                                    <li>
                                        <strong>Pastikan <u>data user</u> yang ada di file (.xlsx)/(.xls) berada di baris kedua</strong>
                                    </li>
                                    <li>
                                        <strong>Judul kolom tidak perlu sama persis dengan contoh diatas, data pada kolom mana saja yang
                                            akan diinputkan dari file (.xlsx)/(.xls) akan disesuaikan pada langkah selanjutnya </strong>
                                    </li>
                                    <?php if ($role == ROLE_MAHASISWA) { ?>
                                        <li>
                                            <strong><u>Password</u> untuk user <u>mahasiswa</u> akan secara otomatis diambilkan dari NIU</strong>
                                        </li>
                                    <?php } elseif ($role == ROLE_DOSEN) { ?>
                                        <li>
                                            <strong><u>Password</u> untuk user <u>dosen</u> akan secara otomatis diambilkan dari NIP/NIKA</strong>
                                        </li>

                                    <?php }  ?>
                                </ul>
                            </div>

                            <?php echo form_open_multipart('akademik/user/upload_data_user/' . $role); ?>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <input id="role" type="hidden" name="role" class="form-control col-md-7 col-xs-12" value="<?php echo $role ?>">
                                    <div style="border:2px dashed #E0E0E0">
                                        <input type="file" class="form-control-file" id="file_excel" name="file_excel">
                                    </div>
                                    <br>
                                </div>
                                <div class="col-md-6 col-md-offset-3">
                                    <center>
                                        <button class="btn btn-success" type="submit">Submit</button>
                                    </center>
                                </div>
                            </div>
                            </form>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url() . 'elusistatic/js/addEditUser.js' ?>"></script>