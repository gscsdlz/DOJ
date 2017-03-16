<?php
var_dump ( $args );
$base = $args [0] [0];
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
			<div class="tab-content" style="padding-top: 20px;">
				<div role="tabpanel" class="tab-pane active" id="base">
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<form>
								<div class="form-group">
									<label for="contest_title">比赛名称</label> <input type="text"
										class="form-control" id="contest_title" placeholder="请输入比赛名称"
										value="<?php echo $base['contest_name'];?>">
								</div>
								<div class="form-group">
									<label for="contest_title">比赛开始时间 1970-01-30 00:00:00</label> <input
										type="text" class="form-control" id="contest_title"
										placeholder="请输入比赛开始时间"
										value="<?php echo date('Y-m-d H:i:s', $base['c_stime'])?>">
								</div>
								<div class="form-group">
									<label for="contest_title">比赛开始时间 1970-01-30 00:00:00</label> <input
										type="text" class="form-control" id="contest_title"
										placeholder="请输入比赛开始时间"
										value="<?php echo date('Y-m-d H:i:s', $base['c_etime'])?>">
								</div>
								<div class="form-group">
									<label for="contest_title">比赛管理员</label> <input type="text"
										class="form-control" id="contest_title"
										placeholder="请输入比赛管理员的名称"
										value="<?php echo $base['username'];?>">
								</div>
<?php
for($i = 1; $i < count ( $prolist ); $i++) {
	echo '<label class="checkbox-inline"><input checked="true" type="checkbox" id="' . $prolist [$i] [0] . 'pro" value="option1"><a href="/contest/problem/show/'.$prolist[$i][0].'">' . $prolist [$i] [0] . ' ' . $prolist [$i] [1] . '</a></label>';
}
?>
<p>&nbsp;</p>
								<div class="form-group">
									<label for="contest_title">添加新题目</label> <br/><input type="text" class="form-control col-md-2" id="newpro" placeholder="请输入题目ID" value="">
									<p>&nbsp;</p>
									<label id="newtitle" class="text-danger">新题目名字</label>
									<button type="button" class="btn btn-primary">添加</button>
								</div>
								<br/>
								<div class="form-group text-center">
									<button type="button" style="width:100px" class="btn btn-success">保存</button>
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

