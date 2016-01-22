<?php 
require "timer.class.php";
require "conn.php";
$timer= new Timer(); 
$timer->start();
ini_set("max_execution_time", 10000);
header("Content-type: text/html; charset=utf-8");
$sql = 'select * from lanqiao_spider_changwei';
if (!$result = mysql_query($sql,$link)){
	echo mysql_error();
}
$timer->stop();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>蓝桥杯题库 - 昌维</title>

	<link rel="stylesheet" href="http://cdn.amazeui.org//amazeui/2.5.1/css/amazeui.min.css"><link rel="stylesheet" href="http://s.amazeui.org/assets/2.x/css/amaze.min.css?v=ijl1vloy"><!--[if (gte IE 9)|!(IE)]><!--><script src="http://s.amazeui.org/assets/2.x/js/jquery.min.js"></script><!--<![endif]--><!--[if lt IE 9]><script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
		<script src="http://cdn.amazeui.org/modernizr/2.8.3/modernizr.js"></script>
		<script src="http://s.amazeui.org/assets/2.x/js/amazeui.ie8polyfill.min.js"></script><![endif]--><script src="http://cdn.amazeui.org//amazeui/2.5.1/js/amazeui.min.js"></script><link rel="canonical" href="http://amazeui.org/getting-started?_ver=2.x"/>

	<style type="text/css">
	.get {
	  background: #1E5B94;
	  color: #fff;
	  text-align: center;
	  padding: 50px 0;
	}

	.get-title {
	  font-size: 200%;
	  border: 2px solid #fff;
	  padding: 20px;
	  display: inline-block;
	}

	.get-btn {
	  background: #fff;
	}
	
	.footer p {
	  color: #7f8c8d;
	  margin: 0;
	  padding: 15px 0;
	  text-align: center;
	  background: #2d3e50;
	}

	td {
		white-space:nowrap;
	}
</style>
	</head>
	<body>
		<header class="am-topbar am-topbar-fixed-top">
			<div class="am-container">
				<h1 class="am-topbar-brand">
				<a href="#">蓝桥杯题库</a>
				</h1>

				<button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-secondary am-show-sm-only"
				data-am-collapse="{target: '#collapse-head'}"><span class="am-sr-only">导航切换</span> <span
				class="am-icon-bars"></span></button>

				<div class="am-collapse am-topbar-collapse" id="collapse-head">
					<ul class="am-nav am-nav-pills am-topbar-nav">
						<li class="am-active"><a href="index.php">首页</a></li>
						<li><a href="https://github.com/cw1997/lanqiao-spider">开源项目</a></li>
						<li><a href="http://www.changwei.me">作者博客</a></li>
					</ul>
				</div>
			</div>
		</header>

		<div class="get">
			<div class="am-g">
				<div class="am-u-lg-12">
					<h1 class="get-title">蓝桥杯题库 - 在线版</h1>

					<p>
						知识分享，人人成长。
					</p>

					<p>
						<a href="#table" class="am-btn am-btn-sm get-btn">获取新get技能√</a>
					</p>
				</div>
			</div>
		</div>
		<hr>
		<div class="am-container">
			<a name="table"></a>
			<table class="am-table am-table-bordered am-table-radius am-table-striped am-table-hover">
				<tr>
					<th>id</th>
					<th>title</th>
					<th>limit</th>
					<th>link</th>
				</tr>
				<?php while ($rs = mysql_fetch_assoc($result)) { ?>
				<tr class="am-panel am-panel-default" data-am-scrollspy="{animation: 'slide-bottom'}" >
					<td><?php echo $rs['id'] ?></td>
					<td><a target="_blank" href="view.php?id=<?php echo $rs['id'] ?>"><?php echo $rs['lanqiao_title']; ?></a></td>
					<td><?php echo $rs['lanqiao_limit']; ?></td>
					<td><a target="_blank" href="<?php echo $rs['lanqiao_href']; ?>"><?php echo $rs['lanqiao_href']; ?></a></td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
	<footer class="footer">
	  <p>© 2016 <a href="http://www.changwei.me" target="_blank">昌维的博客</a> QQ:867597730 脚本执行时间：<?php echo $timer->spent() ?> 秒 </p>
	</footer>
</body>
</html>