<?php
/**
 * Created by nad.
 * Date: 26/03/2018
 * Time: 21:14
 * Description:
 */
//var_dump($yudisiumInfo);
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Persetujuan Yudisium</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <!--berkas mahasiswa-->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Daftar Mahasiswa Mengajukan<small></small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Tanggal Daftar</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(!empty($yudisiumInfo))
                        {
                            foreach($yudisiumInfo as $record)
                            {
                        ?>
                        <tr>
                            <td><?php echo date_format(date_create_from_format('Y-m-d',substr($record->createdDtm,0,10)), 'd/m/Y') ?></td>
                            <td><?php echo $record->nim ?></td>
                            <td><?php echo $record->nama ?></td>
                            <?php if ($record->status == 'disetujui') {
                                echo "<td><span class=\"label label-success\">" . $record->status . "</span></td>";
                            } elseif ($record->status == 'pending') {
                                echo "<td><span class=\"label label-warning\">" . $record->status . "</span></td>";
                            } else {
                                echo "<td><span class=\"label label-danger\">" . $record->status . "</span></td>";
                            }
                            ?>
                            <td>
                                <a href="<?php echo base_url() ?>akademik/yudisium/detail/<?php echo $record->id_yudisium?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
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
<script>
    $(function () {
        $('#datatable').DataTable({
            'paging' : true,
            'lengthChange' : true,
            'searching' :true,
            'ordering' : false,
            'info' : true,
            'autoWidth' : true
        })
    })
</script>