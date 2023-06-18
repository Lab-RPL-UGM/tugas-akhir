<?php
/**
 * Created by nad.
 * Date: 07/03/2018
 * Time: 11:32
 * Description:
 */
?>
</div>
<!-- /page content -->

<!-- footer content -->
<footer>
    <div class="pull-right">
        KOMSI - Tugas Akhir
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<!-- jQuery -->

<!-- Bootstrap -->
<script src="<?php echo base_url()?>elusistatic/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>elusistatic/vendors/moment/min/moment.min.js"></script>
<!-- bootstrap-wysiwyg -->
<script src="<?php echo base_url()?>elusistatic/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="<?php echo base_url()?>elusistatic/vendors/google-code-prettify/src/prettify.js"></script>
<!-- jQuery autocomplete -->
<script src="<?php echo base_url()?>elusistatic/vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="<?php echo base_url()?>elusistatic/build/js/custom.js"></script>
<!-- Datatables -->
<script src="<?php echo base_url()?>elusistatic/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>elusistatic/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url()?>elusistatic/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url()?>elusistatic/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url()?>elusistatic/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo base_url()?>elusistatic/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?php echo base_url()?>elusistatic/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url()?>elusistatic/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?php echo base_url()?>elusistatic/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?php echo base_url()?>elusistatic/vendors/jszip/dist/jszip.min.js"></script>
<script src="<?php echo base_url()?>elusistatic/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo base_url()?>elusistatic/vendors/pdfmake/build/vfs_fonts.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function($) {
        //initiate dataTables plugin
        var myTable =
            $('#dynamic-table')
                .DataTable( {
                    bAutoWidth: false,
                    "aoColumns": [
                        { "bSortable": false },
                        null, null,null, null, null,
                        { "bSortable": false }
                    ],
                    "aaSorting": [],

                    select: {
                        style: 'multi'
                    }
                } );
    })
</script>
</body>
</html>

