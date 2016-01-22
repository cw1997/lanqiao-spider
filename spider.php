<?php
/**
* @name lanqiao-spider(蓝桥杯题库爬虫)
* @author 昌维 867597730@qq.com
* @include simple_html_dom
* @link www.changwei.me
* @version 1.0.0
*/

// 2016年1月23日 00:12:56

ini_set("max_execution_time", "3600");
// 引入simple_html_dom库
include('simple_html_dom/simple_html_dom.php');
//数据库连接
include('conn.php');
//脚本执行时间统计
include('timer.class.php');

//new一个timer对象并且start开始计算脚本执行时间
$timer= new Timer(); 
$timer->start();

$cookie = 'xxxxxxxxxxxxxxxxxxxxxx';//请输入登录蓝桥杯官网之后在*.lanqiao.org域下的完整cookie
// 新建一个Dom实例
$html = new simple_html_dom();
// exit(url_get('http://lx.lanqiao.org/problem.page?gpid=T1','',$cookie));
for ($i=1; $i < 360; $i++) { 
	$html->load(url_get('http://lx.lanqiao.org/problem.page?gpid=T'.$i,'',$cookie));
	if (!$html->find('div.tit',0)) {
		continue;//如果当前题目无法查看就跳过
	}
	$链接 = 'http://lx.lanqiao.org/problem.page?gpid=T'.$i;
	$标题 = trim(strip_tags($html->find('div.tit',0)));
	$内容 = trim(strip_tags($html->find('div.des',0)));
	$限定 = trim(strip_tags($html->find('div.res',0)));
	$锦囊1 = trim(strip_tags($html->find('div.helpcont',0)));
	$锦囊2 = trim(strip_tags($html->find('div.helpcont',1)));
	$锦囊3 = trim(strip_tags($html->find('div.helpcont',2)));
	// exit($html->find('div.des',0));

	$sql = "INSERT INTO lanqiao_spider_changwei (lanqiao_href,lanqiao_title,lanqiao_content,lanqiao_limit,lanqiao_help1,lanqiao_help2,lanqiao_help3) VALUES ('{$链接}','{$标题}','{$内容}','{$限定}','{$锦囊1}','{$锦囊2}','{$锦囊3}')";
	mysql_query($sql);
	echo mysql_errno().'-'.mysql_error();
	echo "$i<br>";
	// echo $sql."\n";

	$html->clear();
}
$timer->stop();
echo "当前脚本执行时间：".$timer->spent();

function url_get($url,$POSTcontent="",$cookie=""){//这是一个自定义的获取某个url返回结果的函数
    $ch = curl_init();//这一行初始化了一个curl对象
    curl_setopt($ch, CURLOPT_URL,$url);//这一行设置了curl对象要请求的url
    if ($POSTcontent!=""){curl_setopt($ch, CURLOPT_POSTFIELDS,$POSTcontent);}//这一行设置了curl要请求的时候附带上的post数据
    if ($cookie!=""){curl_setopt($ch, CURLOPT_COOKIE,$cookie);}//这一行设置了curl要请求的时候附带上的cookie数据
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//CURLOPT_RETURNTRANSFER设置为1表示如果成功只将结果返回，不自动输出任何内容。
    curl_setopt($ch, CURLOPT_HEADER, 0);//如果你想把一个请求的header也就是头包含在输出中,则设置这个选项为一个非零值。我这里不输出，所以我写0
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);//这一行表示请求超时，一般20就够了
    $output = curl_exec($ch);//这一行开始执行请求并且把请求结果返回给$output变量
    curl_close($ch);//这一行关闭curl对象
    return $output;//这一行把请求结果返回给函数
}