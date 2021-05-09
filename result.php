<?php session_start(); ?>
<?php include "common/header.php" ?>
<?php include "lib/Compare.php" ?>
	<?php
		if(isset($_POST['submit'])){

			$directory1=realpath($_POST['dir1']);
			$directory2=realpath($_POST['dir2']);
			$compare=new Compare($directory1,$directory2);
			$result=$compare->compareDirectory();
	?>

		    <div class="container result">
		    	<a href="index.php" class="btn btn-primary pull-right">Go back</a>
		    	<h3>Directory Comparision Result</h3>
		    	<div class="resultlist">
			    	<h4>Files in <strong><?php echo $directory1 ?></strong> only</h4>
			    	<ul>
			    		<?php foreach($result[0] as $file){ ?>
			    			<li><?php echo $file ?></li>
			    		<?php } ?>
			    	</ul>
			    </div>
			    <div class="resultlist">
			    	<h4>Files in <strong><?php echo $directory2 ?></strong> only</h4>
			    	<ul>
			    		<?php foreach($result[1] as $file){ ?>
			    			<li><?php echo $file ?></li>
			    		<?php } ?>
			    	</ul>
			    </div>

			    <div class="resultlist resultchanged">
			    	<h4>Files changed<span class='instruction pull-right'>+++ &rArr; Lines Added | --- &rArr; Lines Removed | <span class="lineno">1</span> &rArr; Line Number</span></h4>
			    	<ul>
			    		<?php foreach($result[2] as $file){ ?>
			    			<li>
			    				<p><?php echo $file['file'] ?></p>
			    				<?php if(count($file['diff'][0])){ ?>
				    				<ul class="added">
				    					<?php foreach($file['diff'][0] as $line=>$code){ ?>
				    						<li><span class="lineno"><?php echo $line ?></span><span class="code"><?php echo $code ?></span></li>
				    					<?php } ?>
				    				</ul>
				    			<?php } ?>

			    				<?php if(count($file['diff'][1])){ ?>
			    				<ul class="removed">
			    					<?php foreach($file['diff'][1] as $line=>$code){ ?>
			    						<li><span class="lineno"><?php echo $line ?></span><span class="code"><?php echo $code ?></span></li>
			    					<?php } ?>
			    				</ul>
			    				<?php } ?>

			    			</li>
			    		<?php } ?>
			    	</ul>
			    </div>
		    </div>

	<?php } else { ?>
		<div class="container">
			<div class="full-alert">
				<p class="lead">Result not found.</p>
				<a href="index.php" class="btn btn-primary">Go back</a>
			</div>
		</div>
	<?php } ?>

<?php include "common/footer.php" ?>