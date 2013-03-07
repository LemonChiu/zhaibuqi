<!DOCTYPE html>
<html>
<head>
    <title>宅不起 | 更改密码</title>

    <!-- 在head标签内 引入Jquery -->
    <script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>
    <!-- 在head标签内 引入Jquery 验证插件 -->
    <script src="js/jquery.validationEngine.js" type="text/javascript"></script>

    <script type="text/javascript">  
        $(document).ready(function() {
            //验证密码
            $("#sent-mail").validationEngine()
        });
    </script>
    <link type="text/css" rel="stylesheet" href="css/validationEngine.jquery.css" />

    <link type="text/css" rel="stylesheet" href="css/top-nav.css" />
    <link type="text/css" rel="stylesheet" href="css/footer.css" />
    <link type="text/css" rel="stylesheet" href="css/reset-password.css" />

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    <?php require_once("top-nav.php"); ?>
    <div id="container">
        <div id="container-clear-fix">
            <div class="aside">
                <h3>如何使密码更安全？</h3>
                <ul>
                  <li>使用标点符号、数字和大小写字母的组合作为密码。</li>
                  <li>密码中勿包含个人信息（如姓名、生日等）。</li>
                  <li>不使用和其他网站相同的密码。</li>
                  <li>定期修改密码。</li>
                </ul>
            </div>
            <div class="password-box">
                <h2>更改密码</h2>
                <form id="sent-mail" action="#" method="post">
                    <div class="input-box">
                        <p>新的密码</p>
                        <input id="new-password" name="new-password" type="password" size="20"
                        class="validate[required,minSize[6],maxSize[18]] text-input" />
                        <p>确认密码</p>
                        <input id="confirm-password" name="confirm-password" type="password" size="20"
                        class="validate[required,equals[new-password]] text-input" />
                    </div>
                    <div class="tool-bar">
                        <input type="submit" class="sent-btn" value="更改密码" />
                        <a id="back" href="login.php" >返回登陆</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php require_once("footer.php"); ?>
</body>
</html>