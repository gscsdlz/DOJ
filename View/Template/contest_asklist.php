<div class="row">
	<div class="col-md-6 col-md-offset-3 text-center">
		<button data-toggle="modal" data-target="#askModal" type="button"
			class="btn btn-primary">发起提问</button>
		<p>&nbsp;</p>
		<table class="table table-hover">
			<tr>
				<th>题目</th>
				<th>提问者</th>
				<th>主题</th>
				<th>提问时间</th>
			</tr>
		</table>
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
			<div class="modal-body">
				<form class="form-horizontal" role="form">
					<div class="form-group">
						<label for="" class="col-sm-2 control-label">选择题目</label>
						<div class="col-sm-10">
							<select id="pro_id" class="form-control">
								<option value="0">ALL</option>
								<option value="1000">1000</option>
								<option value="1001">1001</option>
								<option value="1002">1002</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="inputUsername" class="col-sm-2 control-label">问题概要</label>
						<div class="col-sm-10">
							<textarea class="form-control" id="topic_question"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="inputPassword" class="col-sm-2 control-label">验证码</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="loginvcodeText"
								placeholder="请输入验证码"> <label id="lvcodeEmptyError"
								class="control-label text-danger">验证码不能为空</label> <label
								id="lvcodeError" class="control-label text-danger">验证码错误</label>
						</div>
						<img src="/login/vcode" alt="验证码区域" id="loginvcodeImg" /> <a
							href="#" id="loginnewVcode">看不清楚,换一张</a>
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
	$(document).ready(function(){
			$("#submit").click(function(){
				var pro_id = $("#pro_id").val();
				var topic = $("#topic_question").val();
				if(topic.length == 0) {
					$("#topicEmptyError").show();
				} else {
					$.post("/contest/submit", {pro_id:pro_id, topic:topic}, function(data){
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

