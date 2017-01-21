<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<nav>
			<ul class="pagination pagination-lg">
				<li><a href="#">&laquo;</a></li>
				<li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">&raquo;</a></li>
			</ul>
		</nav>
		<table class="table table-hover">
			<tr>
				<th>Problem Id</th>
				<th>Problem</th>
				<th>AC Ratio</th>
			</tr>

			<!--<tr class="success">
				<td>1000</td>
				<td align="left"><a href="showproblem.php?pid=1000">&nbsp;A
						+ B Problem</a></td>
				<td>31.27%(<a href="status.php?pid=1000&amp;status=5">191570</a>/<a
					href="status.php?pid=1000">612622</a>)
				</td>
			</tr>
			 <tr class="danger">
				<td>1001 <span class="badge">14</span></td>
				<td align="left"><a href="showproblem.php?pid=1001">&nbsp;Sum
						Problem</a></td>
				<td>25.10%(<a href="status.php?pid=1001&amp;status=5">109310</a>/<a
					href="status.php?pid=1001">435538</a>)
				</td>
			</tr>-->
			<?php
			foreach ( $args as $row ) {
				echo '<tr><td>' . $row [0] . '</td>';
				echo '<td align="left"><a href="/problem/show/' . $row [0] . '">&nbsp;' . $row [1] . '</a></td>';
				echo '<td>'.$row[2].'/'. $row[3].'</td></tr>' . "\n";
			}
			?>
		</table>
		<nav>
			<ul class="pagination pagination-lg">
				<li><a href="#">&laquo;</a></li>
				<li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">&raquo;</a></li>
			</ul>
		</nav>
	</div>
</div>
﻿
