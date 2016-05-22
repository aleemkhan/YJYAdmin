<?php
    include('header.php');
?>
<style>
	#content.row{

	}
</style>
<div class="row" id="content">
	<div class="col-xs-8 col-xs-offset-2">
		<div clas=="row">
			<div class="col-xs-6">
				<div class="form-group">
					<input type="text" class="form-control" id="fname" placeholder="First Name">
				</div>
			</div>
			<div class="col-xs-6">
				<div class="form-group">
					<input type="text" class="form-control" id="lname" placeholder="Last Name">
				</div>
			</div>
		</div>
		<div clas=="row">
			<div class="col-xs-12">
				<div class="form-group">
					<input type="email" class="form-control" id="email" placeholder="Email">
				</div>
			</div>
		</div>
		<div clas=="row">
			<div class="col-xs-12">
				<div class="form-group">
					<input type="password" class="form-control" id="password" placeholder="Password">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-8">
				<div class="form-group">
					<input type="text" class="form-control" id="address" placeholder="Address">
				</div>
			</div>
			<div class="col-xs-4">
				<div class="form-group">
					<input type="text" class="form-control" id="appartment" placeholder="Appartment #">
				</div>
			</div>
		</div>
		<div clas=="row">
			<div class="col-xs-4">
				<div class="form-group">
					<input type="text" class="form-control" id="code" placeholder="Code: e.g (+966)">
				</div>
			</div>
			<div class="col-xs-8">
				<div class="form-group">
					<input type="text" class="form-control" id="phone" placeholder="Mobile">
				</div>
			</div>
		</div>
		<div clas=="row">
			<div class="col-xs-12">
				<select id="type" class="form-control">
					<option value="1">Customer</option>
					<option value="2">Vendor</option>
				</select>
			</div>
		</div>
		<div clas=="row">
			<div class="col-xs-12">
				<br>
				<a href="#" onclick="addUserByAdmin();" class="btn btn-success col-xs-4">Add User</a>
			</div>
		</div>
	</div>

</div>
<script>
	
</script>
<?php
    include('footer.php');
?>