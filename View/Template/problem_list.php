<div class="row">
	<div class="col-md-6 col-md-offset-3 text-center">
		<?php
		
		if (isset ( $_GET ['pageid'] )) {
			$pageid = $_GET['pageid'];
			?>
		<nav>
			<ul class="pagination pagination-lg">
				<li><a
					href="/problem/page/<?php if($pageid == 0 ) echo 0; else echo $pageid - 1;?>">&laquo;</a></li>
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
					href="/problem/page/<?php if($pageid + 1 == $maxPage) echo $pageid; else echo $pageid + 1; ?>">&raquo;</a></li>
			</ul>
		</nav>
		<?php }?>
		<table class="table table-hover text-left">
			<tr>
				<th>题目编号</th>
				<th>题目名</th>
				<th>题目通过率</th>
			</tr>
			<?php
			
			if (isset ( $args ) && count ( $args ) != 0) {
				$contest_id = $args[0][0];
				foreach ( $args as $row ) {
					
					if (! isset ( $row [2] ))
						continue;
						// $row[4] => 是否通过
						// $row[5] => 次数
					if (isset ( $row [4] ))
						echo '<tr class="success">';
					else if (isset ( $row [5] ) && $row [5] > 0)
						echo '<tr class="danger">';
					else
						echo '<tr>';
					echo '<td>' . $row [0];
					if (isset ( $row [5] ) && $row [5] > 0)
						echo '<span class="badge">' . $row [5] . '</span>';
					echo '</td>';
					echo '<td align="left"><a href="/problem/show/' . $row [0] . '">&nbsp;' . $row [1] . '</a></td>';
					echo '<td>' . $row [2] . '/' . $row [3] . '</td></tr>' . "\n";
				}
			} else {
				echo '<tr><td colspan="3" class="text-danger text-center">找不到题目</td></tr>';
			}
			?>
		</table>
		<?php
		if (isset ( $_GET ['pageid'] )) {
			$pageid = $_GET['pageid'];
		?>
		<nav>
			<ul class="pagination pagination-lg">
				<li><a
					href="/problem/page/<?php if($pageid == 0 ) echo 0; else echo $pageid - 1;?>">&laquo;</a></li>
				
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
					href="/problem/page/<?php if($pageid + 1 == $maxPage) echo $pageid; else echo $pageid + 1; ?>">&raquo;</a></li>
			</ul>
		</nav>
		<?php }?>
	</div>
</div>
﻿

