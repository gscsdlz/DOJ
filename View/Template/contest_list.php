<div class="row">
	<div class="col-md-8 col-md-offset-2">
	<div class="panel panel-danger">
	<?php
		if($args) {
	?>
			<div class="panel-heading text-center text-danger"><h3>正在进行中的比赛</h3></div>
			<div class="panel-body">
				<table class="table table-hover">
					<tr>
						<th>编号</th>
						<th>比赛名称</th>
						<th>开始时间</th>
						<th>结束时间</th>
						<th>管理员</th>
						<th>类型</th>
					</tr>
			<?php
			$time = time ();
			foreach ( $args as $row ) {
				if ($time >= $row ['c_stime'] && $time <= $row ['c_etime']) {
					echo '<tr>';
					echo '<td>' . $row ['contest_id'] . '</td>';
					echo '<td><a href="/contest/show/' . $row ['contest_id'] . '">' . $row ['contest_name'] . '</a></td>';
					echo '<td>' . date ( "Y-m-d H:i:s", $row ['c_stime'] ) . '</td>';
					echo '<td>' . date ( "Y-m-d H:i:s", $row ['c_etime'] ) . '</td>';
					echo '<td><a href="/user/show/' . $row ['username'] . '">' . $row ['username'] . '</a></td>';
					if ($row ['contest_pass'])
						echo '<td>需要密码</td>';
					else
						echo '<td>公开</td>';
					echo "<tr>\n";
				}
			}
			?>
		</table>
			</div>
		</div>
		<div class="panel panel-info">
			<div class="panel-heading text-center text-info"><h3>还未开始的比赛</h3></div>
			<div class="panel-body">
				<table class="table table-hover">
					<tr>
						<th>编号</th>
						<th>比赛名称</th>
						<th>开始时间</th>
						<th>结束时间</th>
						<th>管理员</th>
						<th>类型</th>
					</tr>
			<?php
			
			foreach ( $args as $row ) {
				if ($time < $row ['c_stime']) {
					echo '<tr>';
					echo '<td>' . $row ['contest_id'] . '</td>';
					echo '<td><a href="/contest/show/' . $row ['contest_id'] . '">' . $row ['contest_name'] . '</a></td>';
					echo '<td>' . date ( "Y-m-d H:i:s", $row ['c_stime'] ) . '</td>';
					echo '<td>' . date ( "Y-m-d H:i:s", $row ['c_etime'] ) . '</td>';
					echo '<td><a href="/user/show/' . $row ['username'] . '">' . $row ['username'] . '</a></td>';
					if ($row ['contest_pass'])
						echo '<td>需要密码</td>';
					else
						echo '<td>公开</td>';
					echo "<tr>\n";
				}
			}
			?>
		</table>
			</div>
		</div>
		<div class="panel panel-success">
			<div class="panel-heading text-center text-success"><h3>已经结束的比赛</h3></div>
			<div class="panel-body">
				<table class="table table-hover">
					<tr>
						<th>编号</th>
						<th>比赛名称</th>
						<th>开始时间</th>
						<th>结束时间</th>
						<th>管理员</th>
						<th>类型</th>
					</tr>
			<?php
			foreach ( $args as $row ) {
				if ($time > $row ['c_etime']) {
					echo '<tr>';
					echo '<td>' . $row ['contest_id'] . '</td>';
					echo '<td><a href="/contest/show/' . $row ['contest_id'] . '">' . $row ['contest_name'] . '</a></td>';
					echo '<td>' . date ( "Y-m-d H:i:s", $row ['c_stime'] ) . '</td>';
					echo '<td>' . date ( "Y-m-d H:i:s", $row ['c_etime'] ) . '</td>';
					echo '<td><a href="/user/show/' . $row ['username'] . '">' . $row ['username'] . '</a></td>';
					if ($row ['contest_pass'])
						echo '<td>需要密码</td>';
					else
						echo '<td>公开</td>';
					echo "<tr>\n";
				}
			}
			?>
		</table>
			</div>
			<?php } else {?>
				<div class="panel-body text-center text-danger"><h3>目前还没有任何比赛</h3></div>
			<?php }?>
		</div>
	</div>
</div>
