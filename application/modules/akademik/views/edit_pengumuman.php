<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Pengumuman
                <small>Edit</small>
            </h3>
        </div>
    </div>
    <?php //var_dump($dataPengumuman); ?>

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Detail Pengumuman</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
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
                    <?php echo form_open_multipart('akademik/pengumuman/edit' ,'id="addEditPengumumanForm" onSubmit="post_editor()"'); ?>
                    <div class="row">
                        <label>Judul</label>
                        <input type="hidden" name="id_p" id="id_p" value="<?php echo $dataPengumuman[0]->id_pengumuman; ?>">
                        <input id="judul" name="judul" type="text" class="form-control" value="<?php echo $dataPengumuman[0]->judul; ?>">
                        <br>
                    </div>
                    <div class="row">
                        <div class="x_content">
                            <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor-one">
                                <div class="btn-group">
                                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size">
                                        <i class="fa fa-text-height"></i>&nbsp;
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a data-edit="fontSize 5">
                                                <p style="font-size:17px">Huge</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-edit="fontSize 3">
                                                <p style="font-size:14px">Normal</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-edit="fontSize 1">
                                                <p style="font-size:11px">Small</p>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="btn-group">
                                    <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)">
                                        <i class="fa fa-bold"></i>
                                    </a>
                                    <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)">
                                        <i class="fa fa-italic"></i>
                                    </a>
                                    <a class="btn" data-edit="strikethrough" title="Strikethrough">
                                        <i class="fa fa-strikethrough"></i>
                                    </a>
                                    <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)">
                                        <i class="fa fa-underline"></i>
                                    </a>
                                </div>

                                <div class="btn-group">
                                    <a class="btn" data-edit="insertunorderedlist" title="Bullet list">
                                        <i class="fa fa-list-ul"></i>
                                    </a>
                                    <a class="btn" data-edit="insertorderedlist" title="Number list">
                                        <i class="fa fa-list-ol"></i>
                                    </a>
                                    <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)">
                                        <i class="fa fa-dedent"></i>
                                    </a>
                                    <a class="btn" data-edit="indent" title="Indent (Tab)">
                                        <i class="fa fa-indent"></i>
                                    </a>
                                </div>

                                <div class="btn-group">
                                    <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)">
                                        <i class="fa fa-align-left"></i>
                                    </a>
                                    <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)">
                                        <i class="fa fa-align-center"></i>
                                    </a>
                                    <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)">
                                        <i class="fa fa-align-right"></i>
                                    </a>
                                    <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)">
                                        <i class="fa fa-align-justify"></i>
                                    </a>
                                </div>

                                <div class="btn-group">
                                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink">
                                        <i class="fa fa-link"></i>
                                    </a>
                                    <div class="dropdown-menu input-append">
                                        <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                                        <button class="btn" type="button">Add</button>
                                    </div>
                                    <a class="btn" data-edit="unlink" title="Remove Hyperlink">
                                        <i class="fa fa-cut"></i>
                                    </a>
                                </div>

                                <div class="btn-group">
                                    <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)">
                                        <i class="fa fa-undo"></i>
                                    </a>
                                    <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)">
                                        <i class="fa fa-repeat"></i>
                                    </a>
                                </div>
                            </div>

                            <div id="editor-one" class="editor-wrapper">
                                <?php echo $dataPengumuman[0]->deskripsi; ?>
                            </div>
                            <!-- <a onClick="show()">dsfsdfsd</a> -->

                        </div>
                        <div class="row">
                            <textarea name="deskripsi" id="deskripsi" style="display:none" value=""></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <center>
                                <a id="changeFileLabel" onClick="unHide()"><u>Ubah Lampiran</u></a>
                            </center>
                            <center>
                                <a id="cancelFile" onClick="unHide()"><u>Cancel</u></a>
                            </center>
                        </div>
                    </div>
                    <div id="uploadForm">
                        <div class="row">
                            <label>Lampiran
                                <small>format file : pdf atau jpg</small>
                            </label>
                            <input id="lampiran" name="lampiran" type="file">
                        </div>
                    </div>
                    <a href="<?php echo base_url() ?>akademik/pengumuman/" class="btn btn-danger pull-right">Cancel</a>
                    <button class="btn btn-primary pull-right">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url() . 'elusistatic/js/addEditPengumuman.js'?>"></script>
<script>
    function post_editor() {
        x = document.getElementById('deskripsi');
        y = $('#editor-one').html();

        x.value = y;
    }
</script>
<script>
    var x = document.getElementById("uploadForm");
    var y = document.getElementById("cancelFile");
    var z = document.getElementById("changeFileLabel");

    y.style.cursor = "pointer";
    z.style.cursor = "pointer";
    x.style.display = "none";
    y.style.display = "none";

    function unHide() {
        if (x.style.display === "none") {
            x.style.display = "block";
            y.style.display = "block";
            z.style.display = "none";
        } else {
            x.style.display = "none";
            y.style.display = "none";
            z.style.display = "block";
        }
    }
</script>