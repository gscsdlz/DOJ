<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div>

			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#contest0"
					aria-controls="contest0" role="tab" data-toggle="tab">正在进行中的比赛</a></li>
				<li role="presentation"><a href="#contest1" aria-controls="contest1"
					role="tab" data-toggle="tab">还未开始的比赛</a></li>
				<li role="presentation"><a href="#contest2" aria-controls="contest2"
					role="tab" data-toggle="tab">已经结束的比赛</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="contest0">
					<div class="panel panel-danger">
	<?php
	if ($args) {
		?>
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
				if ($row ['contest_pass'] == 1)
					echo '<td>公开</td>';
				else if ($row ['contest_pass'] == 2)
					echo '<td>私有比赛</td>';
				else
					echo '<td>需要密码</td>';
				echo "<tr>\n";
			}
		}
		?>
		</table>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="contest1">
					<div class="panel panel-info">
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
				if ($row ['contest_pass'] == 1)
					echo '<td>公开</td>';
				else if ($row ['contest_pass'] == 2)
					echo '<td>私有比赛</td>';
				else
					echo '<td>需要密码</td>';
				echo "<tr>\n";
			}
		}
		?>
		</table>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="contest2">
					<div class="panel panel-success">
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
				if ($row ['contest_pass'] == 1)
					echo '<td>公开</td>';
				else if ($row ['contest_pass'] == 2)
					echo '<td>私有比赛</td>';
				else
					echo '<td>需要密码</td>';
				echo "<tr>\n";
			}
		}
		?>
		</table>
						</div>
			<?php } else {?>
				<div class="panel-body text-center text-danger">
							<h3>目前还没有任何比赛</h3>
						</div>
			<?php }?>
		</div>
				</div>
			</div>

		</div>



	</div>
</div>
