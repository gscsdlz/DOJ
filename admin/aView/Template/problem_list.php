<div class="row">
	<div class="col-md-6 col-md-offset-3 text-center">
		<table class="table table-hover text-left">
			<tr>
				<th>题目编号</th>
				<th>题目名</th>
				<th>操作</th>
			</tr>
			<?php
			/**
			 * $args => [0] => pms, maxSIZE
			 * $args => [1...n] => pro_id, pro_title;
			 */
			if (isset ( $args ) && count ( $args ) != 0) {
				foreach ( $args as $row ) {
					
					if ($row[0] < 1000)
						continue;
					echo '<tr>';
					echo '<td>' . $row [0].'</td>';
					echo '<td align="left"><a href="/problem/show/' . $row [0] . '">&nbsp;' . $row [1] . '</a></td>';
					echo '<td><button type="button" class="btn btn-success">修改题目</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger">删除题目</button></td></tr>' . "\n";
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
					href="/admin/problemM/page/<?php if($pageid == 0 ) echo 0; else echo $pageid - 1;?>">&laquo;</a></li>
				
				<?php
			echo '<li><a href="/admin/problemM/page/0">0</a></li>';
			echo '<li><a href="#">...</a></li>';
			
			$maxPage = ceil ( $args [0] [0] / $args [0] [1] );
			for($i = 1; $i < $maxPage - 1; ++ $i)
				echo '<li><a href="/admin/problemM/page/' . $i . '">' . $i . '</a></li>';
			
			echo '<li><a href="#">...</a></li>';
			echo '<li><a href="/admin/problemM/page/' . ($maxPage - 1) . '">' . ($maxPage - 1) . '</a></li>';
			?>
				<li><a
					href="/admin/problemM/page/<?php if($pageid + 1 == $maxPage) echo $pageid; else echo $pageid + 1; ?>">&raquo;</a></li>
			</ul>
		</nav>
		<?php }?>
	</div>
</div>
﻿

