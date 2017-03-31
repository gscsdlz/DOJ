<div class="row">
	<div class="col-md-6 col-md-offset-3 text-center">
		<button data-toggle="modal" <?php if(isset($_SESSION['username'])) echo 'data-target="#askModal"'; else echo 'data-target="#signModal"';?> type="button"
			class="btn btn-primary">发起提问</button>
		<p>&nbsp;</p>
		<table class="table table-hover">
			<tr>
				<th>问题编号</th>
				<th>题目</th>
				<th>提问者</th>
				<th>主题</th>
				<th>提问时间</th>
				<th>其他</th>
			</tr>
			<?php
				global $contest;
				if(isset($args[1]) && count($args[1])) {
					foreach($args[1]  as $row) {
						echo '<tr>';
						echo '<td><a href="/contest/ask/'.$contest.'/'.$row[0].'">'.$row[0].'</a></td>';
						if($row[5] == 0)
							echo '<td>全局消息</td>';
						else
							echo '<td><a href="/contest/problem/'.$row[2].'/'.$row[5].'">'.$row[5].'</a></td>';
						echo '<td><a href="/user/show/'.$row[6].'">'.$row[6].'</a></td>';
						echo '<td>'.htmlspecialchars($row[1]).'</td>';
						echo '<td>'.date("Y-m-d H:i:s", $row[4]).'</td>';
						if(isset($_SESSION['username']) && ($_SESSION ['username'] == $row[6] || $_SESSION['privilege'][0] == 1 || isset($_SESSION['privilege'][1][$contest]))) {
							echo '<td><button data-toggle="modal"  data-target="#deleteModal" type="button" class="btn btn-danger" id="del'.$row[0].'">删除</button></td>';
						}
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
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
				<button type="button" class="btn btn-danger" id="deleteAsk">删除</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="askModal" tabindex="-1" role="dialog"
	aria-labelledby="askModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h2 class="modal-title" id="codeModalLabel">发起提问</h2>
			</div>
			<div class="modal-body text-center">
				<form class="form-horizontal" role="form">
				<label class=" control-label text-danger" id="topicError">未知错误，请重试</label>
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">选择题目</label>
						<div class="col-sm-10">
							<select id="pro_id" class="form-control">
								<option value="0">ALL</option>
								<?php
									if(isset($args[0]) && count($args[0])) {
										foreach($args[0] as $row) {
											if($row[0] >= 1000)
											echo '<option value="'.$row[0].'">'.$row[0].'</option>';
										}
									}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="inputUsername" class="col-sm-2 control-label">问题概要</label>
						<div class="col-sm-10  text-center">
							<textarea class="form-control" id="topic_question"></textarea>
							<label class=" control-label text-danger" id="topicEmptyError">问题为空</label>
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
			$("#deleteAsk").click(function(){
				$.post("/ask/delete_question", {question_id:id, <?php global $contest; echo 'cid:'.$contest;?>}, function(data) {
					var arr = eval("(" + data + ")");
					if(arr['status'] == true)
						window.location.reload();
					else
						$("#errorInfo").append('<span class="text-danger">删除失败。请重试</span>');
				})	
			})
			$(".btn-danger").click(function(){	
				if($(this).id != 'deleteAsk')
				id = parseInt($(this).attr("id").substr(3));			
			})
			$("#topicEmptyError").hide();
			$("#topicError").hide();
			$("#submit").click(function(){
				$("#topicEmptyError").hide();
				$("#topicError").hide();
				var pro_id = $("#pro_id").val();
				var topic = $("#topic_question").val();
				if(topic.length == 0) {
					$("#topicEmptyError").show();
				} else {
					$.post("/ask/submit_question", {pro_id:pro_id, topic:topic, contest:<?php global $contest; echo $contest;?>}, function(data){
						var arr = eval("(" + data +")");
						if(arr['status']) {
							window.location.reload();
						} else {
							$("#topicError").show();
						}
					});
				}
			})
	})
</script>

