<script type="text/javascript" src="<?php echo base_url('public'); ?>/assets/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.10/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('public'); ?>/assets/js/script.js"></script>
<script type="text/javascript">
function logout(e){
	swal({
	title: 'Are you sure?',
	text: "You will be logout from the admin!!",
	type: 'warning',
	showCancelButton: true,
	confirmButtonColor: '#3085d6',
	cancelButtonColor: '#d33',
	confirmButtonText: 'Yes, Logout'
	}).then((result) => {
	if (result.value) {
	window.location.href = e;
	}
	})
}
function delete_data_all(e){
	swal({
	title: 'Are you sure?',
	text: "You want to delete the data!!!",
	type: 'warning',
	showCancelButton: true,
	confirmButtonColor: '#3085d6',
	cancelButtonColor: '#d33',
	confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
	if (result.value) {
	window.location.href = e;
	}
	})
}
</script>