
<div class="row">
	<div class="col-md-2 col-md-offset-2 text-center well"
		style="border-right-style: inset">
		<img src="/Src/Image/header.jpg" alt="" class="img-circle"
			width="200px">
		<h1>
			gscsdlz <small>Daemon</small>
		</h1>
		<h2>
			<small>I Will Always Love You..........</small>
		</h2>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<button type="button" class="btn btn-primary btn-block">Edit
					Information</button>
			</div>
		</div>
		<hr />
		<table class="table text-left">
			<tr>
				<td>StudentID</td>
				<td>14070642</td>
			</tr>
			<tr>
				<td>National</td>
				<td>China</td>
			</tr>
			<tr>
				<td>Joined On</td>
				<td>2016-11-3 20:13</td>
			</tr>
			<tr>
				<td>Mail</td>
				<td>lz842063523@foxmail.com</td>
			</tr>
		</table>
	</div>
	<div class="col-md-5 well" id="AllStatus"
		style="height: 300px; margin-left: 10px;"></div>

	<div class="col-md-5 well" id="SubmitFre"
		style="height: 300px; margin-left: 10px"></div>
	<div class="col-md-5 col-md-offset-4">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<form class="form-inline" role="form">
					<button type="submit" class="btn btn-danger" data-toggle="modal"
						data-target="#ACModal">已经解决的问题</button>
					<button type="submit" class="btn btn-success" data-toggle="modal"
						data-target="#nACModal">还未解决的问题</button>
				</form>
			</div>
		</div>
	</div>
</div>
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

<div class="modal fade" id="ACModal" tabindex="-1" role="dialog"
	aria-labelledby="ACModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">已经解决的问题</h4>
			</div>
			<div class="modal-body">
				<table class="table">
					<tr>
						<td><a href="#">1000</a></td>
						<td>1001</td>
						<td>1002</td>
						<td>1003</td>
						<td>1004</td>
						<td>1005</td>
						<td>1000</td>
						<td>1001</td>
						<td>1002</td>
						<td>1003</td>
						<td>1004</td>
						<td>1005</td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="nACModal" tabindex="-1" role="dialog"
	aria-labelledby="nACModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">还未解决的问题</h4>
			</div>
			<div class="modal-body">
				<table class="table">
					<tr>
						<td>1000</td>
						<td>1001</td>
						<td>1002</td>
						<td>1003</td>
						<td>1004</td>
						<td>1005</td>
						<td>1000</td>
						<td>1001</td>
						<td>1002</td>
						<td>1003</td>
						<td>1004</td>
						<td>1005</td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
  <script type="text/javascript">
		// 基于准备好的dom，初始化echarts实例
		var myChartAllStatus = echarts.init(document
				.getElementById('AllStatus'));
		optionA = {
			tooltip : {
				trigger : 'item',
				formatter : "{a} <br/>{b} : {c} ({d}%)"
			},
			legend : {
				orient : 'vertical',
				left : 'left',
				data : [ 'AC', 'WA', 'CE', 'TLE', 'MLE', 'OLE', 'RE', 'PE' ]
			},
			series : [ {
				name : 'Total Submit',
				type : 'pie',
				radius : [ '50%', '70%' ],
				avoidLabelOverlap : false,
				label : {
					normal : {
						show : false,
						position : 'center'
					},
					emphasis : {
						show : true,
						textStyle : {
							fontSize : '30',
							fontWeight : 'bold'
						}
					}
				},
				labelLine : {
					normal : {
						show : false
					}
				},
				data : [ {
					value : <?php echo $args[0];?>,
					name : 'AC'
				}, {
					value : <?php echo $args[1];?>,
					name : 'PE'
				}, {
					value : <?php echo $args[2];?>,
					name : 'WA'
				}, {
					value : <?php echo $args[3];?>,
					name : 'RE'
				}, {
					value : <?php echo $args[4];?>,
					name : 'TLE'
				}, {
					value : <?php echo $args[5];?>,
					name : 'MLE'
				}, {
					value : <?php echo $args[6];?>,
					name : 'OLE'
				}, {
					value : <?php echo $args[7];?>,
					name : 'CE'
				} ]
			} ]
		};

		myChartAllStatus.setOption(optionA);
	</script>
