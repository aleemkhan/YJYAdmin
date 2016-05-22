<?php
    include('header.php');
?>

<div class="row" id="content">
    <div id="total" class="col-lg-4">
    </div>
    <div id="credits" class="col-lg-4">
    </div>
    <div id="today" class="col-lg-4">
    </div>
</div>
<script>
	$(document).ready(function(){
		loadTotalEarnings();
	});
</script>
<?php
    include('footer.php');
?>