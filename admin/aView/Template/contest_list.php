<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<table class="table table-hover">
		<tr>
			<th>编号</th>
			<th>比赛名称</th>
			<th>状态</th>
			<th>开始时间</th>
			<th>比赛时间</th>
			<th>比赛管理员</th>
			<th>权限分类</th>
			<th colspan="2" >操作</th>
		</tr>
<?php
	$time = time();
	if(isset($args) && count($args)) {
		foreach ($args as $row) {
			echo '<tr>';
			echo '<td>'.$row['contest_id'].'</td>';
			echo '<td><a href="/contest/show/'.$row['contest_id'].'">'.$row['contest_name'].'</a></td>';
			if($time < $row['c_stime'])
				echo '<td class="text-success">还未开始</td>';
			else if($time > $row['c_etime'])
				echo '<td>已结束</td>';
			else
				echo '<td class="text-danger>正在进行中</td>';
			echo '<td>'.date("Y-m-d H:i:s", $row['c_stime']).'</td>';
			echo '<td>'.date("Y-m-d H:i:s", $row['c_etime']).'</td>';
			echo '<td>'.$row['username'].'</td>';
			echo '<td>';
			if($row['contest_pass'] == 1)
				echo '公开';
			else if($row['contest_pass'] == 2)
				echo '私有比赛';
			else
				echo '需要密码';
			echo '</td>';
			echo '<td colspan="2"><button type="button" class="btn btn-success">编辑</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-danger">删除</button></td>';
			echo '</tr>';
			
		}
	}
?>
		</table>
	</div>
</div>