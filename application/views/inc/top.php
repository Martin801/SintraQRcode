<?php $site_lang = $this->session->userdata('site_lang'); ?>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo SITE_NAME; ?></title>
<link rel="stylesheet" href="<?php echo base_url('public'); ?>/assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('public'); ?>/assets/css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('public'); ?>/assets/css/style.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('public'); ?>/assets/css/media.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url('public'); ?>/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
$(document).ready( function () {
    $('table').DataTable();
} );	
</script>