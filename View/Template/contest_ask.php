<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-default">
			<div class="panel-head">
				<ol class="breadcrumb">
					<?php
					if (isset ( $args [0] ) && count ( $args [0] )) {
						if ($args [0] [5] < 1000) {
							echo '<li><a href="#">全局消息</a></li>';
						} else {
							echo '<li><a href="/contest/problem/' . $args [0] [2] . '/' . $args [0] [5] . '">' . $args [0] [5] . '</a></li>';
						}
						echo '<li><a href="/user/show/' . $args [0] [6] . '">' . $args [0] [6] . '</a></li>';
						echo '<li class="active">' . $args [0] [1] . '</li>';
						echo '<li class="active">' . date ( "Y-m-d H:i:s", $args [0] [4] ) . '</li>';
						echo '<li><button type="button" data-toggle="modal" ';
						if (isset ( $_SESSION ['username'] ))
							echo 'data-target="#answerModal"';
						else
							echo 'data-target="#signModal"';
						echo ' class="btn btn-success">回复</button></li>';
					}
					?>
				</ol>

			</div>
			<div class="panel-body">
			<?php
			if (isset ( $args [1] ) && count ( $args [1] )) {
				$len = count ( $args );
				for($i = 1; $i < $len; ++ $i) {
					echo '<div class="panel panel-default"><div class="panel-head"><ol class="breadcrumb">';
					echo '<li><a href="/user/show/' . $args [$i] [5] . '">' . $args [$i] [5] . '</a></li>';
					echo '<li class="active">' . date ( "Y-m-d H:i:s", $args [$i] [4] ) . '</li>';
					if (isset ( $_SESSION ['user_id'] ) && $args [$i] [3] == $_SESSION ['user_id'])
						echo '<li><button id="del'.$args[$i][0].'"type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" >删除</button></li>';
					echo '</ol></div><div class="panel-body">';
					echo $args [$i] [2];
					echo "</div></div>\n";
				}
				?>
			<?php } else { ?>
				<div class="panel panel-default">
					<div class="panel-head">
						<ol class="breadcrumb">
							<li class="active">此问题暂时无人评论</li>
						</ol>
					</div>
				</div>
			<?php }?>
		</div>
		</div>
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
			<div class="model-body text-center" id="errorInfo"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-danger" id="deleteAnswer">删除</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="answerModal" tabindex="-1" role="dialog"
	aria-labelledby="answerModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h2 class="modal-title" id="answerModalLabel">发起回复</h2>
			</div>
			<div class="modal-body text-center">
				<form class="form-horizontal" role="form">
					<label class=" control-label text-danger" id="answerError">未知错误，请重试</label>
					<div class="form-group">
						<label for="inputUsername" class="col-sm-2 control-label">回复内容</label>
						<div class="col-sm-10  text-center">
							<textarea class="form-control" id="topic_answer"></textarea>
							<label class=" control-label text-danger" id="answerEmptyError">问题为空</label>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-primary" id="submit">提交</button>
			</div>
		</div>
	</div>
</div>
<script>
	var id;
	$(document).ready(function(){
			$("#deleteAnswer").click(function(){
				$.post("/ask/delete_answer", {answer_id:id}, function(data) {
					var arr = eval("(" + data + ")");
					if(arr['status'] == true)
						window.location.reload();
					else
						$("#errorInfo").append('<span class="text-danger">删除失败。请重试</span><br/>');
				})	
			})
			$(".btn-danger").click(function(){	
				id = parseInt($(this).attr("id").substr(3));			
			})
			$("#answerEmptyError").hide();
			$("#answerError").hide();
			$("#submit").click(function(){
				$("#answerEmptyError").hide();
				$("#answerError").hide();
				var answer = $("#topic_answer").val();
				if(answer.length == 0) {
					$("#answerEmptyError").show();
				} else {
					$.post("/ask/submit_answer", {answer:answer, question_id:<?php echo $args[0][0];?>}, function(data){
						var arr = eval("(" + data +")");
						if(arr['status']) {
							window.location.reload();
						} else {
							$("#answerError").show();
						}
					});
				}
			})
	})
</script>