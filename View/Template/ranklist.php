<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<table class="table table-hover">
			<tr>
				<th>排名</th>
				<th>用户名</th>
				<th>签名</th>
				<th>通过题目数</th>
				<th>提交题目数</th>
				<th>AC率</th>
			</tr>
			<?php
				if(isset($args)) {
					var_dump($args);
					foreach($args as $row) {
						if(isset($_SESSION['username']) && $_SESSION['username'] == $row[0]){
							echo '<tr class="bg-danger">';
						} else {
							echo '<tr>';
						}
						echo '<td>'.$row[4].'</td>';
						echo '<td>'.$row[0].'</td>';
						echo '<td>'.$row[1].'</td>';
						echo '<td>'.$row[2].'</td>';
						echo '<td>'.$row[3].'</td>';
						if($row[3] == 0)
							$row[3] = 1;
						echo '<td>'.number_format($row[2] / $row[3] * 100, 2, '.', '').'%</td>';
						echo "</tr>\n";
					}
				}
			?>
		</table>
	</div>
</div>
<?php
