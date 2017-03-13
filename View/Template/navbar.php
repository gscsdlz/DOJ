<nav class="navbar navbar-inverse" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Welcome to NUC Online Judge</a>
			</div>
			<div class="collapse navbar-collapse"
				id="bs-example-navbar-collapse-1">
				<?php
				/**
				 * 分离自header.php
				 */
				global $contest; // 参数引自@config.php
				if (! $contest) {
					?>
				<ul class="nav navbar-nav">
					<li><a href="/">首页</a></li>
					<li><a href="/problem/page">题目</a></li>
					<li><a href="/status">状态</a></li>
					<li><a href="/rank/page">排名</a></li>
					<li><a href="/contest/page">比赛</a></li>
					<li><a href="#">帮助</a></li>
				</ul>
				<form class="navbar-form navbar-left" role="search" method="get"
					action="/problem/search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="输入题目或者来源信息	"
							name="key"
							value="<?php if(isset($_GET['key'])) echo $_GET['key'];?>">
					</div>
					<button type="submit" class="btn btn-default">搜索</button>
				</form>
				<?php }  else {?>
				<ul class="nav navbar-nav">
					<li><a href="/contest/page">比赛列表</a></li>
					<li class="active"><a href="/contest/show/<?php echo $contest;?>">题目</a></li>
					<li><a href="/status?cid=<?php echo $contest;?>">状态</a></li>
					<li><a href="/contest/ranklist/<?php echo $contest;?>">排名</a></li>
					<li><a href="/contest/asklist/<?php echo $contest;?>">问答</a></li>
				</ul>
				<?php }?>
				<?php
				if (! isset ( $_SESSION ['username'] )) {
					$loginStatus = false;
					?>
				<ul class="nav navbar-nav navbar-right">
					<li data-toggle="modal" data-target="#signModal"><a href="#">登录</a></li>
					<li data-toggle="modal" data-target="#regModal"><a href="#">注册</a></li>
				</ul>
				<?php
				} else {
					$loginStatus = true;
					?>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown" id="realname"><?php  echo $_SESSION['username'];?><span
							class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="/user/show/<?php echo $_SESSION['username']?>">用户界面</a></li>
				<?php if($_SESSION['privilege'][0] == 1) 
						  echo '<li><a href="/admin/">后台管理</a></li>';
					  else if(isset($_SESSION['privilege'][1]))
					  	  echo '<li><a href="/admin/contestManager">比赛管理</a></li>';
				?>
							<li class="divider"></li>
							<li id="logout"><a href="#">退出登录</a></li>
						</ul></li>
				</ul>
				<?php }?>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>
	<?php if(!$loginStatus) { ?>
	<div class="modal fade" id="signModal" tabindex="-1" role="dialog"
		aria-labelledby="signModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<h2 class="modal-title" id="codeModalLabel">登录</h2>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" role="form">
						<div class="form-group text-center text-danger">
							<label id="loginError" class="control-label ">用户名不存在或密码错误，请重试</label>
						</div>
						<div class="form-group">
							<label for="inputUsername" class="col-sm-2 control-label">用户名</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="inputUsername"
									name="username" placeholder="请输入用户名">
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword" class="col-sm-2 control-label">密码</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="inputPassword"
									name="password" placeholder="请输入密码">
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
					<button type="button" class="btn btn-primary" id="sign">登录</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="regModal" tabindex="-1" role="dialog"
		aria-labelledby="regModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<h2 class="modal-title" id="codeModalLabel">注册</h2>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" role="form">
						<div class="form-group">
							<label for="Username" class="col-sm-2 control-label">用户名</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="Username"
									name="newUsername" placeholder="Username"> <label
									id="nameEmptyError" class="control-label text-danger">用户名不能为空！</label>
								<label id="nameError" class="control-label text-danger">用户名已经注册过了！</label>
							</div>
						</div>
						<div class="form-group">
							<label for="nickname" class="col-sm-2 control-label">昵称</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="Nickname"
									name="newNickname" placeholder="Nickname">
							</div>
						</div>
						<div class="form-group">
							<label for="password" class="col-sm-2 control-label">密码</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="Password"
									name="newPassword" placeholder="Password"> <label
									id="passwordEmptyError" class="control-label text-danger">密码不能为空</label>

							</div>
						</div>
						<div class="form-group">
							<label for="password2" class="col-sm-2 control-label">确认密码</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="Password2"
									name="newPassword2" placeholder="Password2"> <label
									id="passwordError" class="control-label text-danger">两次输入的密码不一致</label>

							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-sm-2 control-label">电子邮箱</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="Email" name="email"
									placeholder="email"> <label id="emailEmptyError"
									class="control-label text-danger">电子邮箱不能为空！</label> <label
									id="emailError" class="control-label text-danger">该电子邮箱已经被注册过了！</label>
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword" class="col-sm-2 control-label">验证码</label>

							<div class="col-sm-4">
								<input type="text" class="form-control" id="regvcodeText"
									placeholder="请输入验证码"> <label id="rvcodeEmptyError"
									class="control-label text-danger">验证码不能为空</label> <label
									id="rvcodeError" class="control-label text-danger">验证码错误</label>
							</div>
							<img src="/login/vcode" alt="验证码区域" id="loginvcodeImg" /> <a
								href="#" id="regnewVcode">看不清楚,换一张</a>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-primary" id="reg">注册</button>
				</div>
			</div>
		</div>
	</div>
	<?php }?>
	<script>
		$(document).ready(function() {
	<?php if(!$loginStatus) { ?>

		$("#lvcodeEmptyError").hide();
		$("#lvcodeError").hide();
		$("#rvcodeEmptyError").hide();
		$("#rvcodeError").hide();
		
		$("#loginnewVcode").click(function(){
			var randId = new Date().getTime();
			$("#loginvcodeImg").attr("src", "/login/vcode/"+randId);	
		});
		$("#regnewVcode").click(function(){
			var randId = new Date().getTime();
			$("#regvcodeImg").attr("src", "/login/vcode/"+randId);	
		});
		
		$("#loginError").hide();
			$("#ul2").hide();
			$("#nameEmptyError").hide();
			$("#passwordEmptyError").hide();
			$("#emailEmptyError").hide();
			$("#nameError").hide();
			$("#passwordError").hide();
			$("#emailError").hide();

			$("#sign").click(function() {
				$("#loginError").hide();
				$("#lvcodeEmptyError").hide();
				$("#lvcodeError").hide();
				var username = $("#inputUsername").val();
				var password = $("#inputPassword").val();
				var vcode = $("#loginvcodeText").val();
				if(vcode.length == 0)
					$("#lvcodeEmptyError").show();
				else
				$.post("/login", {
					username : username,
					password : password,
					vcode : vcode
				}, function(data) {
					var arr = eval("(" + data + ")");
					if (arr['status'] == 'vcode error') {
						$("#lvcodeError").show();
						var randId = new Date().getTime();
						$("#loginvcodeImg").attr("src", "/login/vcode/"+randId);
					} else if(arr['status'] == true){
						window.location.reload();
					} else {
						var randId = new Date().getTime();
						$("#loginvcodeImg").attr("src", "/login/vcode/"+randId);
						$("#inputUsername").val("");
						$("#inputPassword").val("");
						$("#loginError").show();
					}
				})
			})
			$("#reg").click(function() {
				$("#nameEmptyError").hide();
				$("#passwordEmptyError").hide();
				$("#emailEmptyError").hide();
				$("#nameError").hide();
				$("#passwordError").hide();
				$("#emailError").hide();
				$("#rvcodeEmptyError").hide();
				$("#rvcodeError").hide();

				var vcode = $("#regvcodeText").val();
				var username = $("#Username").val();
				var nickname = $("#Nickname").val();
				var password = $("#Password").val();
				var password2 = $("#Password2").val();
				var email = $("#Email").val();
				if (username.length == 0)
					$("#nameEmptyError").show();
				else if (password.length == 0)
					$("#passwordEmptyError").show();
				else if (password !== password2)
					$("#passwordError").show();
				else if (email.length == 0)
					$("#emailEmptyError").show();
				else if(vcode.length == 0)
					$("#rvcodeEmptyError").show();
				else
					$.post("/login/register", {
						newUsername : username,
						newPassword : password,
						newPassword2 : password,
						newNickname : nickname,
						email : email,
						vcode : vcode
					}, function(data) {
						var arr = eval("(" + data + ")");
						if (arr['status'] == 'username error') {
							$("#nameError").show();
						} else if (arr['status'] == 'email error') {
							$("#emailError").show();
						} else if(arr['status'] == 'vcode error') {
							var randId = new Date().getTime();
							$("#regvcodeImg").attr("src", "/login/vcode/"+randId);	
							$("#rvcodeError").show();
						} else if (arr['status'] == true) {
							window.location.reload();
						}
					})
			})
	<?php }?>
		$("#logout").click(function() {
				$.post("/login/logout", function(data) {
					var arr = eval("(" + data + ")");
					if (arr['status']) {
						var d = new Date();
						d.setTime(d.getTime() + (-1 * 24 * 60 * 60 * 1000));
						var expires = "expires=" + d.toUTCString();
						document.cookie = "username= ;" + expires;
						window.location.reload();
					}
				})
			})
		})
	</script>
	﻿