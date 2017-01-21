<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<h1 class="text-center text-primary"><?php echo $pro_title;?></h1>
		<h4 class="text-center text-danger">Time Limit: <?php echo $time_limit;?>MS Memory
			Limit: <?php echo $memory_limit;?>KB</h4>
		<h4 class="text-center text-danger">Total Submission(s): 612628
			Accepted Submission(s): 191573</h4>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="panel panel-default">
					<div class="panel-heading">Problem Description</div>
					<div class="panel-body"><?php echo $pro_descrip;?></div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Input</div>
					<div class="panel-body"><?php echo $pro_in;?></div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Output</div>
					<div class="panel-body"><?php echo $pro_out;?></div>
				</div>
				<div class="panel panel-default panel-danger">
					<div class="panel-heading">Sample Input</div>
					<div class="panel-body"><?php echo $pro_dataIn;?></div>
				</div>
				<div class="panel panel-default  panel-danger">
					<div class="panel-heading">Sample Output</div>
					<div class="panel-body"><?php echo $pro_dataOut;?></div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Author</div>
					<div class="panel-body"><?php echo $author;?></div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Hint</div>
					<div class="panel-body"><?php echo $hint?></div>
				</div>
				<div class="panel panel-default">
					<div class="panel-body text-center">
						<button type="button" class="btn btn-danger btn-lg"
							data-toggle="modal" data-target="#codeModal">Submit</button>
						<button type="button" class="btn btn-success btn-lg">Statistics</button>
						<button type="button" class="btn btn-info btn-lg">Discuss</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="codeModal" tabindex="-1" role="dialog"
	aria-labelledby="codeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="codeModalLabel">Parse Code</h4>
			</div>
			<div class="modal-body">
				<form class="form-inline">
					<div class="form-group">
						<input type="text" class="form-control" name="pid"
							value="<?php echo $pro_id;?>"> <select class="form-control"
							name="lang">
							<option value="0">G++</option>
							<option value="1">GCC</option>
							<option value="2">Java</option>
							<option value="3">C#</option>
							<option value="4">Python</option>
						</select>
					</div>
				</form>
				<p></p>
				<div class="form-group">
					<textarea class="form-control" rows="10" name="code"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="submitCode">Submit</button>
			</div>
		</div>
	</div>
</div>
﻿
