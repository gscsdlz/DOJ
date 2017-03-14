<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<h1 class="text-center text-primary"><?php echo $pro_title;?></h1>
		<h4 class="text-center text-danger">时间限制: <?php echo $time_limit;?>ms 内存限制: <?php echo $memory_limit;?>KB</h4>
		<h4 class="text-center text-danger">通过次数: <span class="badge"><?php echo $aSubmit;?></span>
			总提交次数: <span class="badge"><?php echo $tSubmit;?></span></h4>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="panel panel-default">
					<div class="panel-heading">问题描述</div>
					<div class="panel-body"><?php echo $pro_descrip;?></div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">输入描述</div>
					<div class="panel-body"><?php echo $pro_in;?></div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">输出描述</div>
					<div class="panel-body"><?php echo $pro_out;?></div>
				</div>
				<div class="panel panel-default panel-danger">
					<div class="panel-heading">样例输入</div>
					<div class="panel-body"><pre><?php echo $pro_dataIn;?></pre></div>
				</div>
				<div class="panel panel-default  panel-danger">
					<div class="panel-heading">样例输出</div>
					<div class="panel-body"><pre><?php echo $pro_dataOut;?></pre></div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">来源</div>
					<div class="panel-body"><?php echo $author;?></div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">提示</div>
					<div class="panel-body"><?php echo $hint?></div>
				</div>
				<div class="panel panel-default">
					<div class="panel-body text-center">
						<button type="button" class="btn btn-danger btn-lg"
							data-toggle="modal"
							data-target="#<?php if(isset($_SESSION['username'])) echo 'codeModal'; else echo 'signModal';?>">提交</button>
						<button type="button" class="btn btn-success btn-lg">统计</button>
						<button type="button" class="btn btn-info btn-lg">讨论</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
if (isset ( $_SESSION ['username'] )) {
	?>
<div class="modal fade" id="codeModal" tabindex="-1" role="dialog"
	aria-labelledby="codeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="codeModalLabel">请选择适当的语言并粘贴代码</h4>
			</div>
			<div class="modal-body">
				<form class="form-inline">
					<div class="form-group">
						<h4 id="submitCodeError" class="text-danger">提交错误，请重试</h4>
						<input type="text" readonly="readonly" class="form-control" id="pid"
							value="<?php echo $pro_id;?>"> <select class="form-control"
							id="lang">
							<?php
	global $langArr;
	$i = 0;
	foreach ( $langArr as $row ) {
		if ($i == 0) {
			$i ++;
			continue;
		}
		echo '<option value="' . $i ++ . '">' . $row . '</option>';
	}
	?>
						</select>

					</div>
				</form>
				<label id="missPidError" class="text-danger">题目编号为空或非法</label>
				<p></p>
				<div class="form-group">
					<textarea class="form-control" rows="10" id="code"></textarea>
					<label id="emptyCodeError" class="text-danger">代码为空</label>
					<p></p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				<button type="button" class="btn btn-primary" id="submitCode">提交</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){

		$("#missPidError").hide();
		$("#emptyCodeError").hide();
		$("#submitCodeError").hide();
		
		$("#submitCode").click(function(){
			$("#missPidError").hide();
			$("#emptyCodeError").hide();
			$("#submitCodeError").hide();
			var pid = $("#pid").val();
			var lang = $("#lang").val();
			var codes = $("#code").val();
			
			if(pid.length != 4)
				$("#missPidError").show();
			else if(codes.length == 0)
				$("#emptyCodeError").show();
			else 
			$.post("/submit", {pro_id:pid, lang:lang, codes:codes<?php global $contest; if($contest) echo ',contestId:'.$contest;?>}, function(data){
				var obj = eval("(" + data + ")");
				if(obj['status'] == true) {
					<?php
						if($contest) {
							echo 'location.href="/status?cid='.$contest.'";';
						} else {
							echo 'location.href="/status";';
						}
					?>
				} else {
					$("#submitCodeError").show();
				}
			})
		})
		 $("textarea").on('keydown', function(e) {
                if (e.keyCode == 9) {
                    e.preventDefault();
                    var indent = '    ';
                    var start = this.selectionStart;
                    var end = this.selectionEnd;
                    var selected = window.getSelection().toString();
                    selected = indent + selected.replace(/\n/g, '\n' + indent);
                    this.value = this.value.substring(0, start) + selected
                            + this.value.substring(end);
                    this.setSelectionRange(start + indent.length, start
                            + selected.length);
                }
            })
	})
</script>
﻿<?php }?>
