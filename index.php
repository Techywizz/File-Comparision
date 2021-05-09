<?php include "common/header.php" ?>

    <div class="container">
    	<form method="post" action="result.php" class="formCompare">
	    	<div class="col-md-12">
	    		<label>Enter directory path and click on Compare</label>
	    	</div>
	    	<div class="col-md-4">
		  		<label>Directory 1</label>
		  		<input type="text" name="dir1" class="form-control" value="dir/v1">
	    	</div>
	    	<div class="col-md-4">
		  		<label>Directory 2</label>
		  		<input type="text" name="dir2" class="form-control" value="dir/v2">
	    	</div>
	    	<div class="col-md-4">
				<button class="btn btn-primary btnCompare" name="submit" value="Compare">Compare</button>
	    	</div>
	    </form>

	    <div class="col-md-12 formProcess" style="display: none">
		    <div class="full-alert">
				<p class="lead"><img src='img/loader.gif'> Processing, please wait...</p>
			</div>
		</div>

    </div>

<?php include "common/footer.php" ?>