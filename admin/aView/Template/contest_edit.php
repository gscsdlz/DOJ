<?php
if (isset ( $args [0] [0] ))
	$base = $args [0] [0];
if (isset ( $args [1] ))
	$prolist = $args [1];
?>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div>
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#base"
					aria-controls="home" role="tab" data-toggle="tab">比赛基本信息</a></li>
				<li role="presentation"><a href="#user" aria-controls="profile"
					role="tab" data-toggle="tab">用户管理</a></li>
				<li role="presentation"><a href="#submit" aria-controls="messages"
					role="tab" data-toggle="tab">提交管理</a></li>
				<li role="presentation"><a href="#balloon" aria-controls="settings"
					role="tab" data-toggle="tab">气球管理</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content well" style="padding-top: 20px;">
				<div role="tabpanel" class="tab-pane active" id="base">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<form class="form-horizontal">
								<div class="form-group">
									<label for="contest_name" class="col-sm-4">比赛名称</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="contest_name"
											placeholder="请输入比赛名称"
											value="<?php if(isset($base['contest_name'])) echo $base['contest_name'];?>">
									</div>
								</div>
								<div class="form-group">
									<label for="username" class="col-sm-4">比赛管理员</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="username"
											placeholder="请输入比赛管理员"
											value="<?php if(isset($base['username'])) echo $base['username'];?>">
									</div>
								</div>
								<div class="form-group">
									<label for="contest_pass" class="col-sm-4">比赛权限</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="contest_pass"
											placeholder="请输入权限"
											value="<?php if(isset($base['contest_pass'])) echo $base['contest_pass'];?>">
									</div>
								</div>
								<label class="text-danger"> 1表示公开 2表示私有比赛(指定用户可参加)
									6位以上字符表示参加比赛需要使用该密码</label>
								<p>&nbsp;</p>
								<div class="form-group">
									<label for="c_stime" class="col-sm-4">比赛开始时间<br />格式：1970-01-30
										00:00:00
									</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="c_stime"
											placeholder="请输入开始时间"
											value="<?php if(isset($base['c_stime'])) echo date('Y-m-d H:i:s', $base['c_stime'])?>">
									</div>
								</div>
								<div class="form-group">
									<label for="c_etime" class="col-sm-4">比赛结束时间<br />格式：1970-01-30
										00:00:00
									</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" id="c_etime"
											placeholder="请输入结束时间"
											value="<?php if(isset($base['c_etime']))echo date('Y-m-d H:i:s', $base['c_etime'])?>">
									</div>
								</div>
								<label for="contest_title">比赛题目列表 <span class="text-danger">双击题目实际ID
										即可删除当前题目</span></label>
								<div id="prolist">
						<?php
						if (isset ( $prolist ))
							for($i = 1; $i < count ( $prolist ); $i ++) {
								echo '<div class="form-group">';
								echo '<div class="col-sm-4"><input value="' . $prolist [$i] [0] . '" type="text" class="form-control"/></div>';
								echo '<div class="col-sm-4"><input readonly="true" ondblclick="delete_pro($(this).parent().parent())" value="' . $prolist [$i] [4] . '" type="text" class="form-control" /></div>';
								echo '<div class="col-sm-4"><label><a href="/problem/show/' . $prolist [$i] [4] . '" target="_blank">' . $prolist [$i] [1] . '</a></label></div>';
								echo '</div>';
							}
						?>
							</div>
								<div class="form-group">
									<div class="col-sm-4">
										<input id="pro_id" value="" type="text" class="form-control"
											placeholder="请填写题目实际编号" />
									</div>
									<div class="col-sm-4">
										<label><a id="pro_title" href="javascript:void(0)">请填写题目实际编号</a></label>
									</div>
								</div>
								<div class="form-group text-center">
									<button type="button" style="width: 100px"
										class="btn btn-primary" id="add">确认添加</button>
								</div>
								<hr />
								<p class="text-danger">没有点击保存之前，所做的操作不会同步到数据库中，请不要离开该页面或者刷新页面</p>
								<div class="form-group text-center">
									<button type="button" style="width: 100px"
										class="btn btn-success" id="save">保存</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="user"></div>
				<div role="tabpanel" class="tab-pane" id="submit"></div>
				<div role="tabpanel" class="tab-pane" id="balloon"></div>
			</div>
		</div>
	</div>
</div>
<script>
	var pro_id;
	var pro_title;
	var valid_id = false;
	var prolist = new Array();
	$(document).ready(function(){
		$(window).bind('beforeunload',function(){
			return '您输入的内容尚未保存，确定离开此页面吗？';
		});
		$("#pro_id").keyup(function(){
			valid_id = false;
			pro_id = parseInt($(this).val());
			if(pro_id >= 1000) {
				$.post("/admin/contestM/pro_check", {pro_id:pro_id}, function(data){
					arr = eval("(" + data + ")");
					if(arr['status']) {
						valid_id = true;
						pro_title = arr['pro_title'];
						$("#pro_title").html(arr['pro_title']);
						$("#pro_title").attr("href", "/problem/show/" + pro_id);
						$("#pro_title").attr("target", "_blank");
					} else {
						$("#pro_title").html("题目ID不合法");
						$("#pro_title").attr("href", "javascript:void(0)");
						$("#pro_title").removeAttr("target");
					}
				})
			}
		})
		$("#add").click(function(){
			if(valid_id) {
				$("#prolist").append('<div class="form-group">'+'<div class="col-sm-4"><input placeholder="请输入题目的比赛编号" value="" type="text" class="form-control"/></div>'+'<div class="col-sm-4"><input readonly="true" ondblclick="delete_pro($(this).parent().parent())" value="' + pro_id + '" type="text" class="form-control" /></div>' + '<div class="col-sm-4"><label><a href="/problem/show/' + pro_id + '" target="_blank">' + pro_title+ '</a></label></div>' + '</div>');
				$("#pro_id").val("");
				$("#pro_title").html("请填写题目实际编号");
				$("#pro_title").attr("href", "javascript:void(0)");
				$("#pro_title").removeAttr("target");
			}
		})
		$("#save").click(function(){
			$("h3").remove();
			$("p").remove();
			var ok = true;
			var contest_name = $("#contest_name").val();
			var username = $("#username").val();
			var contest_pass = $("#contest_pass").val();
			var c_stime = parseInt(Date.parse(new Date($("#c_stime").val())) / 1000);
			var c_etime = parseInt(Date.parse(new Date($("#c_etime").val())) / 1000);

			$("#prolist div.form-group").each(function(index){
				var inner_id = $(this).children().eq(0).children().eq(0).val();
				var pro_id = $(this).children().eq(1).children().eq(0).val();
				if(inner_id < 1000) {
					$(this).attr("class", "form-group has-error");
					$(this).append('<p class="text-danger">比赛中的题目ID不合法</p>');
					ok = false;
				}
				prolist[index] = new Array(inner_id, pro_id);
			})
			if(ok) {
				$.post("/admin/contestM/save", {<?php if(isset($base['contest_id'])) echo 'contest_id:'.$base['contest_id'].',';?>contest_name:contest_name,username:username, contest_pass:contest_pass,c_stime:c_stime, c_etime:c_etime, prolist:prolist}, function(data){
					var arr = eval("(" + data + ")");
					if(arr['status']) {
						$(window).unbind('beforeunload');
						window.location.href = "/admin/contestM/edit/" + arr['contest_id'];
					} else {
						$("#base").append('<h3 class=" text-center text-danger">'+arr['info']+'</h3>');
					}
				});
			}
		})
	})

	function delete_pro(pro_dom) {
		$(pro_dom).remove();
	}
</script>
