<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="/View/Template/css/bootstrap.min.css" rel="stylesheet">
<script src="/View/Template/js/jquery.min.js"></script>
<script src="/View/Template/js/jquery.json.js"></script>
<script src="/View/Template/js/bootstrap.min.js"></script>
<title>欢迎来到NUC Online Judge</title>
</head>

<body>
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">NOJ</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse"
				id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="/">首页</a></li>
					<li><a href="/problem/page/0">题目</a></li>
					<li><a href="#">状态</a></li>
					<li><a href="#">排名</a></li>
					<li><a href="#">比赛</a></li>
					<li><a href="#">帮助</a></li>
		<!--  <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>-->
				</ul>
				<form class="navbar-form navbar-left" role="search">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="题目搜索">
					</div>
					<button type="submit" class="btn btn-default">搜索</button>
				</form>

				
				<ul class="nav navbar-nav navbar-right">
					<li data-toggle="modal" data-target="#signModal"><a href="#">登录</a></li>
					<li data-toggle="modal" data-target="#regModal"><a href="#">注册</a></li>
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="realname"><span class="caret"></span></a>
		          <ul class="dropdown-menu" role="menu">
		            <li><a href="#">用户界面</a></li>
		            <li><a href="#">信息修改</a></li>
		            <li class="divider"></li>
		            <li><a href="#">退出登录</a></li>
		          </ul>
				</li>	
				</ul>		
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>
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
									name="username" placeholder="Username">
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword" class="col-sm-2 control-label">密码</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="inputPassword"
									name="password" placeholder="Password">
							</div>
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
									name="newUsername" placeholder="Username">
							</div>
						</div>
						<div class="form-group">
							<label for="nickname" class="col-sm-2 control-label">昵称</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="nickname"
									name="newNickname" placeholder="Nickname">
							</div>
						</div>
						<div class="form-group">
							<label for="password" class="col-sm-2 control-label">密码</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="password"
									name="newPassword" placeholder="Password">
							</div>
						</div>
						<div class="form-group">
							<label for="password2" class="col-sm-2 control-label">确认密码</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="password2"
									name="newPassword2" placeholder="Password2">
							</div>
						</div>
						<div class="form-group">
							<label for="email" class="col-sm-2 control-label">电子邮箱</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="email" name="email"
									placeholder="email">
							</div>
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
	<script>
		$(document).ready(function(){
			$("#loginError").hide();
			$("#ul2").hide();
			$("#sign").click(function(){
				$("#loginError").hide();
				var username = $("#inputUsername").val();
				var password = $("#inputPassword").val();
				$.post("/login/login", {username:username, password:password}, function(data){
					var arr = eval("(" + data + ")");
					if(arr['status']) {
						//
					} else {
						$("#inputUsername").val("");
						$("#inputPassword").val("");
						$("#loginError").show();
					}
				})
			})
		})
	</script>﻿