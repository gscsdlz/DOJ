<div class="row">
	<div class="col-md-6 col-md-offset-3 text-center">
		<nav>
			<ul class="pagination pagination-lg">
				<li><a
					href="/problem/page/<?php if($_GET['id'] == 0 ) echo 0; else echo $_GET['id'] - 1;?>">&laquo;</a></li>
				<?php
				echo '<li><a href="/problem/page/0">0</a></li>';
				echo '<li><a href="#">...</a></li>';
				
				$maxPage = ceil ( $args [0] [0] / $args [0] [1] );
				for($i = 1; $i < $maxPage - 1; ++ $i)
					echo '<li><a href="/problem/page/' . $i . '">' . $i . '</a></li>';
				
				echo '<li><a href="#">...</a></li>';
				echo '<li><a href="/problem/page/' . ($maxPage - 1) . '">' . ($maxPage - 1) . '</a></li>';
				?>
				<li><a
					href="/problem/page/<?php if($_GET['id'] + 1 == $maxPage) echo $_GET['id']; else echo $_GET['id'] + 1; ?>">&raquo;</a></li>
			</ul>
		</nav>
		<table class="table table-hover text-left">
			<tr>
				<th>题目编号</th>
				<th>题目名</th>
				<th>题目通过率</th>
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
				
				if (! isset ( $row [2] ))
					continue;
				echo '<tr><td>' . $row [0] . '</td>';
				echo '<td align="left"><a href="/problem/show/' . $row [0] . '">&nbsp;' . $row [1] . '</a></td>';
				echo '<td>' . $row [2] . '/' . $row [3] . '</td></tr>' . "\n";
			}
			?>
		</table>
		<nav>
			<ul class="pagination pagination-lg">
				<li><a
					href="/problem/page/<?php if($_GET['id'] == 0 ) echo 0; else echo $_GET['id'] - 1;?>">&laquo;</a></li>
				
				<?php
				echo '<li><a href="/problem/page/0">0</a></li>';
				echo '<li><a href="#">...</a></li>';
				
				$maxPage = ceil ( $args [0] [0] / $args [0] [1] );
				for($i = 1; $i < $maxPage - 1; ++ $i)
					echo '<li><a href="/problem/page/' . $i . '">' . $i . '</a></li>';
				
				echo '<li><a href="#">...</a></li>';
				echo '<li><a href="/problem/page/' . ($maxPage - 1) . '">' . ($maxPage - 1) . '</a></li>';
				?>
				<li><a
					href="/problem/page/<?php if($_GET['id'] + 1 == $maxPage) echo $_GET['id']; else echo $_GET['id'] + 1; ?>">&raquo;</a></li>
			</ul>
		</nav>
	</div>
</div>
﻿

