<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<table class="table table-hover table-bordered"
			style="vertical-align: middle;">
			<tr>
				<th>排名</th>
				<th>用户名</th>
				<th>通过题目总数</th>
				<th>总时长</th>
			<?php
			global $contest;
			$maxInnerId = 1000;
			if (isset ( $args [0] ) && count ( $args [0] )) {
				foreach ( $args [0] as $row ) {
					echo '<th><a href="/contest/problem/' . $contest . '/' . $row . '">' . $row . '</a></th>';
					$maxInnerId = $row;
				}
			}
			?>
		</tr>
		<?php
		if (isset ( $args [1] ) && count ( $args [1] )) {
			$k = 1;
			foreach ( $args [1] as $row ) {
				
				echo '<tr><td>' . $k ++ . '</td>';
				echo '<td><a href="/user/show/' . $row [2] . '">' . $row [2] . '</a></td>';
				echo '<td>' . $row [1] . '</td>';
				echo '<td>' . format_time ( $row [0] ) . '</td>';
				for($i = 1000; $i <= $maxInnerId; $i ++) {
					if (isset ( $row [$i] )) {
						echo '<td ';
						if (isset ( $row [$i] [2] ) && $row [$i] [2] == 1) {// 第一个通过该题 
							echo 'class="bg-primary">' . format_time ( $row [$i] [0] );
							if($row[$i][1])
								echo '<br/>(-' . $row [$i] [1] . ')';
						}
						else if ($row [$i] [0] && ! $row [$i] [1]) // 通过且没有罚时
							echo 'class="bg-success">' . format_time ( $row [$i] [0] );
						else if ($row [$i] [0] && $row [$i] [1]) // 通过且有罚时
							echo 'class="bg-success">' . format_time ( $row [$i] [0] ) . '<br/>(-' . $row [$i] [1] . ')';
						else
							echo 'class="bg-danger text-center">-' . $row [$i] [1];
						echo '</td>';
					} else {
						echo '<td></td>';
					}
				}
				echo '</tr>';
			}
		}
		?>
	</table>
	</div>
</div>
