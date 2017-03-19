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
				<th colspan="2">操作</th>
			</tr>
<?php
$time = time ();
if (isset ( $args ) && count ( $args )) {
	foreach ( $args as $row ) {
		echo '<tr>';
		echo '<td>' . $row ['contest_id'] . '</td>';
		echo '<td><a href="/contest/show/' . $row ['contest_id'] . '">' . $row ['contest_name'] . '</a></td>';
		if ($time < $row ['c_stime'])
			echo '<td class="text-success">还未开始</td>';
		else if ($time > $row ['c_etime'])
			echo '<td>已结束</td>';
		else
			echo '<td class="text-danger">正在进行中</td>';
		echo '<td>' . date ( "Y-m-d H:i:s", $row ['c_stime'] ) . '</td>';
		echo '<td>' . date ( "Y-m-d H:i:s", $row ['c_etime'] ) . '</td>';
		echo '<td>' . $row ['username'] . '</td>';
		echo '<td>';
		if ($row ['contest_pass'] == 1)
			echo '公开';
		else if ($row ['contest_pass'] == 2)
			echo '私有比赛';
		else
			echo '需要密码';
		echo '</td>';
		echo '<td colspan="2"><button type="button" class="btn btn-success" onclick="window.location.href=\'/admin/contestM/edit/' . $row ['contest_id'] . '\'">编辑</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger" id="' . $row ['contest_id'] . 'del">删除</button></td>';
		echo '</tr>';
	}
}
?>
		</table>
	</div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
	aria-labelledby="deleteModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h3 class="modal-title" id="codeModalLabel">删除不可逆！确认删除吗？</h3>
			</div>
			<div class="model-body text-center" id="errorInfo">
				<p class="text-danger">
					请注意 删除比赛会导致比赛的提交记录，代码信息等被删除<br />（题目本身不会被删除，参与比赛的用户不会被删除）
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"
					id="closeModel">关闭</button>
				<button type="button" class="btn btn-danger" id="deleteContest">删除</button>
			</div>
		</div>
	</div>
</div>
<script>
		$(document).ready(function(){
			$(".btn-danger").click(function(){
				if($(this).attr("id") != 'deleteContest')
					deleteId = parseInt($(this).attr("id"));
			})

			$("#deleteContest").click(function(){
				$.post("/admin/contestM/del_contest", {contestId:deleteId}, function(data){
					var arr = eval("(" + data + ")");
					if(arr['status'] == true) {
						window.location.reload();
					} else {
						$("#errorInfo").html('<h2 class="text-danger">'+arr['info']+"</h2>");
					}
				})
			})
		})
</script>