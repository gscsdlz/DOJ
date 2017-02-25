<div class="row">
	<div class="col-md-6 col-md-offset-3 text-center">
		<?php
		global $contest; // 引自@config.php
		if ($contest && isset ( $args [0] ) && count ( $args [0] )) {
			$row = $args [0] [0];
			echo '<h1>' . $row ['contest_name'] . '</h1>';
			echo '<h4 class="text-danger">开始时间：' . date ( "Y-m-d H:i:s", $row ['c_stime'] ) . ' 结束时间：' . date ( "Y-m-d H:i:s", $row ['c_etime'] ) . '</h4>';
		}
		?>
		<?php if(isset($args[1]['pass']) && $args[1]['pass'] = true) {?>
			<p>&nbsp;</p>
		<form class="form-horizontal">
			<div class="form-group">
				<label for="ontestpass" class=" col-sm-4 control-label">请输入比赛密码</label>
				<div class="col-sm-4">
					<input type="password" class="form-control" id="contestpass"
						name="contestpass" placeholder="Password"> <label
						id="EmptyContestPass" class=" col-sm-4 control-label text-danger">密码为空</label>
					<label id="ContestPassError"
						class=" col-sm-4 control-label text-danger">密码错误</label>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-10">
					<button type="button" class="btn btn-default" id="submitPass" data-toggle="modal" data-target="#signModal">提交</button>
				</div>
			</div>
		</form>
		<script>
			$("document").ready(function(){
				$("#EmptyContestPass").hide();
				$("#ContestPassError").hide();
				$("#submitPass").click(function(){
					$("#EmptyContestPass").hide();
					$("#ContestPassError").hide();
					var pass = $("#contestpass").val();
					if(pass.length == 0)
						$("#EmptyContestPass").show();
					else
						$.post("/contest/check/<?php echo $contest;?>", {contestpass:pass} , function(data){
							var obj = eval("(" + data + ")");
							if(obj['status'] == false) {
								$("#ContestPassError").show();
							} else {
								window.location.reload();
							}
						})
				})
			})
		</script>
		<?php } else if(isset($args[1]['timeError'])) {?>
			<h3 class="text-success text-center">比赛还未开始 当前时间：<?php echo date('Y-m-d H:i:s',  time());?></h3>
		<?php } else if(isset($args[1]['privilegeError'])) {?>
			<h3 class="text-success text-center">对不起您没有登录或者权限不足，请联系管理员</h3>
		<?php } else if (isset ( $args [1] ) && count ( $args [1] ) != 0) {
			echo <<<EOT
			<table class="table table-hover text-left">
			<tr>
				<th>题目编号</th>
				<th>题目名</th>
				<th>题目通过率</th>
			</tr>
EOT;
			$args = $args [1];
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
			echo '<h3 class="text-success text-center">找不到题目</h3>';
		}
		echo '</table>';
		?>
	</div>
</div>
﻿

