<div class="row">
	<div class="col-md-6 col-md-offset-3 text-center">
		<?php
		global $contest; // 引自@config.php
		if ($contest && isset ( $args [0] ) && count ( $args [0] )) {
			$row = $args [0] [0];
			echo '<h1>' . $row ['contest_name'] . '</h1>';
			echo '<h4 class="text-danger">开始时间：' . date ( "Y-m-d H:i:s", $row ['c_stime'] ) . ' 结束时间：' . date ( "Y-m-d H:i:s", $row ['c_etime'] ) . '</h4>';
			$args = $args [1];
		}
		?>
		<table class="table table-hover text-left">
			<tr>
				<th>题目编号</th>
				<th>题目名</th>
				<th>题目通过率</th>
			</tr>
			<?php
			
			if (isset ( $args ) && count ( $args ) != 0) {
				$contest_id = $args [0] [0];
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
					echo '<td align="left"><a href="/contest/problem/' . $contest_id . '/' . $row [0] . '">&nbsp;' . $row [1] . '</a></td>';
					echo '<td>' . $row [2] . '/' . $row [3] . '</td></tr>' . "\n";
				}
			} else {
				echo '<tr><td colspan="3" class="text-danger text-center">找不到题目</td></tr>';
			}
			?>
		</table>
	</div>
</div>
﻿

