<?php
?>
<h1 class="text-center">修改或新增题目</h1>
<p>&nbsp;</p>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<form class="form-horizontal" method="post">
			<div class="form-group">
				<label for="title" class="col-sm-2 control-label">题目名</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="title"
						value="<?php if(isset($pro_title)) echo $pro_title;?>">
				</div>
				<label for="author" class="col-sm-2 control-label">来源</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="author"
						value="<?php if (isset($author)) echo $author;?>">
				</div>
			</div>
			<div class="form-group">
				<label for="time_limit"
					class="col-sm-2 col-sm-offset-2 control-label">时间限制(ms)</label>
				<div class="col-sm-2">
					<input type="text" class="form-control" id="time_limit"
						value="<?php if (isset($time_limit)) echo $time_limit;?>">
				</div>
				<label for="memory_limit" class="col-sm-2 control-label">内存限制(KB)</label>
				<div class="col-sm-2">
					<input type="text" class="form-control" id="memory_limit"
						value="<?php if (isset($memory_limit)) echo $memory_limit;?>">
				</div>
			</div>
			<!-- 编辑器区域-->
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h1 class="text-center">题目描述</h1>
						</div>
						<div class="panel-body">
							<script id="editor" type="text/plain"
								style="width: 100%; height: 500px;"></script>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h1 class="text-center">输入描述</h1>
						</div>
						<div class="panel-body">
							<script id="editorIn" type="text/plain"
								style="width: 100%; height: 200px;"></script>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h1 class="text-center">输出描述</h1>
						</div>
						<div class="panel-body">
							<script id="editorOut" type="text/plain"
								style="width: 100%; height: 200px;"></script>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="panel panel-danger">
								<div class="panel-heading">
									<h1 class="text-center">输入样例描述</h1>
								</div>
								<div class="panel-body">
									<textarea id="pro_dataIn" rows="" cols="" style="width: 100%; height: 100px"><?php if(isset($pro_dataIn)) echo $pro_dataIn;?></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="panel panel-danger">
								<div class="panel-heading">
									<h1 class="text-center">输出样例描述</h1>
								</div>
								<div class="panel-body">
									<textarea id="pro_dataOut" rows="" cols="" style="width: 100%; height: 100px"><?php if(isset($pro_dataOut)) echo $pro_dataOut;?></textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h1 class="text-center">提示</h1>
						</div>
						<div class="panel-body">
							<script id="editorHint" type="text/plain"
								style="width: 100%; height: 200px;"></script>
						</div>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="text-center">
					<button type="button" class="btn btn-success" style="width: 100px" id="save">保存</button><br />
					<button type="button" class="btn btn-danger" id="errorInfo" style="margin-top:10px;"></button>
				</div>
			</div>
		</form>
	</div>
</div>
<script src="/admin/ueditor/ueditor.config.js"></script>
<script src="/admin/ueditor/ueditor.all.min.js"> </script>
<script src="/admin/ueditor/editor/lang/zh-cn/zh-cn.js"></script>
<script>
	var ue = UE.getEditor('editor'); 
	var ueIn = UE.getEditor('editorIn'); 
	var ueOut = UE.getEditor('editorOut'); 
	var ueHint = UE.getEditor('editorHint'); 
	var arr;
	ue.ready(function() {
		ue.setContent(arr['pro_descrip']);
	});
	ueIn.ready(function(){
		ueIn.setContent(arr['pro_in']);
	});
	ueOut.ready(function(){
		ueOut.setContent(arr['pro_out']);
	});
	ueHint.ready(function(){
		ueHint.setContent(arr['pro_hint']);
	});

	$(document).ready(function(){
		$.post("/admin/problemM/editPost", {<?php if(isset($pro_id)) echo 'id:'.$pro_id?>} , function(data){
			arr = eval("(" + data + ")");
		})
		$("#save").click(function(){
			var time_limit = $("#time_limit").val();
			var memory_limit = $("#memory_limit").val();
			var pro_title = $("#title").val();
			var author = $("#author").val();
			var pro_dataIn = $("#pro_dataIn").val();
			var pro_dataOut = $("#pro_dataOut").val();
			var pro_descrip = ue.getContent();
			var pro_in = ueIn.getContent();
			var pro_out = ueOut.getContent();
			var hint = ueHint.getContent();
			$.post("/admin/problemM/savePro", {<?php if(isset($pro_id)) echo 'pro_id:'.$pro_id.',';?>pro_title:pro_title, time_limit:time_limit, memory_limit:memory_limit, pro_descrip:pro_descrip, pro_in:pro_in,pro_out:pro_out, pro_dataIn:pro_dataIn, pro_dataOut:pro_dataOut, hint:hint, author:author}, function(data) {
				var arr = eval("(" + data + ")");
				$("#errorInfo").html(arr['status']);
			})
		})
	})
</script>
