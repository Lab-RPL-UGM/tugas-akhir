<?php
/**
 * Created by nad.
 * Date: 07/03/2018
 * Time: 11:32
 * Description:
 */
?>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Dashboard</h3>
        </div>
    </div>
    <?php if ($revisiInfo!=false){?>
        <?php if ($revisiInfo[0]->path!=null){?>
        <div class="clearfix"></div>
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Revisi Sidang <small>Silahkan unduh</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <ul>
                        <?php
                        if(!empty($revisiInfo))
                        {
                            $i=1;
                            foreach($revisiInfo as $record)
                            {
                                ?>
                                <li>
                                    <u>
                                        <a href="<?php echo base_url()?>uploads/revisi_sidang/<?php echo $record->path ?>" target="_blank">Revisi-<?php echo $i?></a>
                                    </u>
                                </li>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php }?>
    <?php }?>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Pemberitahuan<small>Kegiatan terakhir</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <ul class="list-unstyled timeline">
                        <?php
                        if(!empty($pesanInfo))
                        {
                            foreach($pesanInfo as $record)
                            {
                            ?>
                        <li>
                            <div class="block">
                                <div class="tags">
                                    <a href="" class="tag">
                                        <span><?php echo substr($record->createdDtm,0,10) ?></span>
                                    </a>
                                    <span class="label label-warning"><?php echo substr($record->createdDtm,10,6) ?></span>
                                </div>
                                <div class="block_content">
                                    <h2 class="title">
                                        <a><?php echo $record->nama ?></a>
                                    </h2>
                                    <div class="byline">
                                        <span></span>
                                    </div>
                                    <p class="excerpt well"><?php echo $record->deskripsi ?></p>
                                </div>
                            </div>
                        </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
