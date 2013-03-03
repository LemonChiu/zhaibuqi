<?php
require_once "php/start-session.php";
?>
<!DOCTYPE html
        PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="宅不起 大学生 活动 推送" />
    <meta name="description" content="宅不起 大学生 活动 推送" />

	<title>宅不起 | 首页</title>

    <link href="css/top-nav.css" type="text/css" rel="stylesheet" />
    <link href="css/index.css" type="text/css" rel="stylesheet" />
    <link href="css/footer.css" type="text/css" rel="stylesheet" />

	<!--[if IE]>
	<style type="text/css"> 
	/* 请将所有版本的 IE 的 css 修复放在这个条件注释中 */
	</style>
	<![endif]-->
</head>

<body>
    <?php require_once("top-nav.php"); ?>
	<div id="container">
			<div id="header">
				<div id="header-nav">
					<ul>
                        <li>
                            <a href="#">全部活动</a>
                        </li>
						<li>
							<a href="#">出去耍</a>
						</li>
						<li>
							<a href="#">社团活动</a>
						</li>
						<li>
							<a href="#">比赛</a>
						</li>
						<li>
							<a href="#">讲座</a>
						</li>
					</ul>
                    <div class="create-new">
                        <?php if(!isset($_SESSION['user_id'])){?>
                            <a href="login.php" title="新建" class="create-btn">
                        <?php }else{ ?>
                            <a href="new-activity.php" title="新建" class="create-btn">
                        <?php }?>
                            <span>&nbsp;&nbsp;</span>
                        </a>
                    </div>
				</div>
			</div>
		<div id="sidebar">
			<h3>动态内容</h3>
				<p>此 div 上所显示的动态内容 </p>
		</div>
		<!-- end #sidebar -->
		<div id="waterfall">
	    	<div class="single-activity" >
                <a class="activity-pic" href=""><img src="images/test.png" alt="图片示例235*350" /></a>
                <a class="activity-title" href="">活动标题</a><br/>
                <p>时间：</p>
                <p>地点：</p>
                <p>活动介绍简介:</p>
            </div>
            <div class="single-activity" >
                <a class="activity-title" href="">活动标题</a><br/>
                <p>时间：</p>
                <p>地点：</p>
                <p>活动介绍简介:</p>
            </div>
            <div class="single-activity" >
                <a class="activity-pic" href=""><img src="images/test.png" alt="图片示例235*350" /></a>
                <a class="activity-title" href="">活动标题</a><br/>
                <p>时间：</p>
                <p>地点：</p>
                <p>活动介绍简介:</p>
            </div>
            <div class="single-activity" >
                <a class="activity-title" href="">活动标题</a><br/>
                <p>时间：</p>
                <p>地点：</p>
                <p>活动介绍简介:</p>
            </div>
            <div class="single-activity" >
                <a class="activity-pic" href=""><img src="images/test.png" alt="图片示例235*350" /></a>
                <a class="activity-title" href="">活动标题</a><br/>
                <p>时间：</p>
                <p>地点：</p>
                <p>活动介绍简介:</p>
            </div>
            <div class="single-activity" >
                <a class="activity-title" href="">活动标题</a><br/>
                <p>时间：</p>
                <p>地点：</p>
                <p>活动介绍简介:</p>
            </div>
		</div>
		<!-- end #Waterfall -->
        <p id="add-tips">正在加载更多活动...</p>
        <b id="to-top"></b>
	</div>
	<!-- end #container -->
    <?php require_once("footer.php"); ?>
    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.masonry.min.js"></script>
    <script type="text/javascript" src="js/waterfall.js"></script>
    <script type="text/javascript" src="js/jquery.index.js"></script>
</body>
</html>
