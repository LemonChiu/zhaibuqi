<<<<<<< HEAD
<?php
require_once('start-session.php');
require_once('util.php');
$dbc = mysqli_connect(host,user,password,database)
    or die ('Error connecting to mysql server');

$email = mysqli_real_escape_string($dbc,trim($_POST['email']));
$passwd1 = mysqli_real_escape_string($dbc,trim($_POST['passwd']));
$passwd2 = mysqli_real_escape_string($dbc,trim($_POST['passwd-repeat']));
$nickname = mysqli_real_escape_string($dbc,trim($_POST['nickname']));
if((isset($_COOKIE['a'])&&($_COOKIE['a']!=$email)&&(!empty($email)))||!isset($_COOKIE['a'])){//换号注册和第一次注册

setcookie('a',$email,time()+(60*10));//10分钟
    echo"sdadsa";
setcookie('b',$nickname,time()+(60*10));
}

if(!empty($email)){
    $email = $email;
}else{
    $email = $_COOKIE['a'];
    $nickname = $_COOKIE['b'];

}
$error =0;
$domain_name="";
$domain=explode("@",$email);
$domain1 = explode(".",$domain[1]);
$domain_name = $domain1[0];
//判定验证码是否正确
$user_pass_phrase = sha1($_POST['validate']);
if ($_SESSION['pass_phrase'] == $user_pass_phrase) {
    //判定输入框是否为空
    if (!empty($email) && !empty($passwd1) && !empty($passwd2) && !empty($nickname) && ($passwd1 == $passwd2)) {
        //判定用户名是否存在
        $query = "SELECT * FROM user WHERE email = '$email'";
        $data = mysqli_query($dbc, $query)
            or die('Error querying database1');
        if (mysqli_num_rows($data) == 0) {
        }else{
            echo "用户名已存在";
            $error =1;
            //跳转回到原页面
            $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname(dirname($_SERVER['PHP_SELF'])) . '/register.php'.'?error='.$error;
            echo"$home_url";
            header('Location: ' . $home_url);
        }
    }else{
        echo "请确保填满所有输入栏，并且两次密码输入相同";
        $error =2;
        //跳转回到原页面
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname(dirname($_SERVER['PHP_SELF'])) . '/register.php'.'?error='.$error;
        header('Location: ' . $home_url);
    }
}else{
    echo "验证码输入错误，请重新输入";
    $error = 3;
    //跳转回到原页面
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname(dirname($_SERVER['PHP_SELF'])) . '/register.php'.'?error='.$error;
    header('Location: ' . $home_url);
}
mysqli_close($dbc);

$x = md5($email);
//$query = "UPDATE user set number = '".$_COOKIE['user_id_number']."' where user_id = $user_id";
//$result = mysqli_query($dbc,$query) ;//向数据库中加入number
$String = base64_encode($email.",".$x.",".$nickname.",".$passwd1);



//echo "<html><body>";
$recipient = $email;  //收件人
$subject = "请激活你的帐号，完成注册";//主题
$message = "尊敬的".$nickname."先生/女士:

欢迎加入宅不起!

请点击下面的链接完成注册：

http://localhost/zhaibuqi/zhaibuqi/php/register.php?p=$String

如果以上链接无法点击，请将上面的地址复制到你的浏览器(如IE)的地址栏进入宅不起。

感谢对宅不起的支持，再次希望您在宅不起的体验有益和愉快！

宅不起 http://www.zhaibuqi.com/
--宅不起

(这是一封自动产生的email，请勿回复.)";

$extra = "495315864@qq.com ";
mail ($recipient, $subject, $message,'From:'. $extra);
$p=base64_encode($email.",".$domain_name);
//$p=$_COOKIE['a'].",".$domain_name;

$home_url = 'http://'. $_SERVER['HTTP_HOST'].dirname(dirname($_SERVER['PHP_SELF'])).'/register-confirm.php?p='.$p;
header('Location:'.$home_url);
mysqli_close($dbc);

//echo "请到 ".$userName." 查阅来自豆瓣的邮件, 从邮件重设你的密码。";
//echo "<body/><html/>";
=======
<?php
require_once('start-session.php');
require_once('util.php');
require_once('class.phpmailer.php');

$dbc = mysqli_connect(host,user,password,database)
    or die ('Error connecting to mysql server');

$email = mysqli_real_escape_string($dbc,trim($_POST['email']));
$passwd1 = mysqli_real_escape_string($dbc,trim($_POST['passwd']));
$passwd2 = mysqli_real_escape_string($dbc,trim($_POST['passwd-repeat']));
$nickname = mysqli_real_escape_string($dbc,trim($_POST['nickname']));
if((isset($_COOKIE['a'])&&($_COOKIE['a']!=$email)&&(!empty($email)))||!isset($_COOKIE['a'])){//换号注册和第一次注册

setcookie('a',$email,time()+(60*10));//10分钟
    echo"sdadsa";
setcookie('b',$nickname,time()+(60*10));
}

$_SESSION['f'] =1;//重发邮件不严重验证码

if(!empty($email)){
    $email = $email;
}else{
    $email = $_COOKIE['a'];
    $nickname = $_COOKIE['b'];

}
$error =0;
$domain_name="";
$domain=explode("@",$email);
$domain1 = explode(".",$domain[1]);
$domain_name = $domain1[0];
//判定验证码是否正确
$user_pass_phrase = sha1($_POST['validate']);
echo $user_pass_phrase.'000000000000000000000000000000';
if($_POST['validate']!=""){
if ($_SESSION['pass_phrase'] == $user_pass_phrase) {
    //判定输入框是否为空
    if (!empty($email) && !empty($passwd1) && !empty($passwd2) && !empty($nickname) && ($passwd1 == $passwd2)) {
        //判定用户名是否存在
        $query = "SELECT * FROM user WHERE email = '$email'";
        $data = mysqli_query($dbc, $query)
            or die('Error querying database1');
        if (mysqli_num_rows($data) == 0) {
        }else{
            echo "用户名已存在";
            $error =1;
            //跳转回到原页面
            $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname(dirname($_SERVER['PHP_SELF'])) . '/register.php'.'?error='.$error;
            echo"$home_url";
            header('Location: ' . $home_url);
            exit;
        }
    }else{
        echo "请确保填满所有输入栏，并且两次密码输入相同";
        $error =2;
        //跳转回到原页面
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname(dirname($_SERVER['PHP_SELF'])) . '/register.php'.'?error='.$error;
        header('Location: ' . $home_url);
        exit;
    }
}else{
    echo "验证码输入错误，请重新输入";
    $error = 3;
    //跳转回到原页面
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname(dirname($_SERVER['PHP_SELF'])) . '/register.php'.'?error='.$error;
    header('Location: ' . $home_url);
    exit;
}
}

$x = md5($email);
//$query = "UPDATE user set number = '".$_COOKIE['user_id_number']."' where user_id = $user_id";
//$result = mysqli_query($dbc,$query) ;//向数据库中加入number
$String = base64_encode($email.",".$x.",".$nickname.",".$passwd1);





$mail = new PHPMailer(); //建立邮件发送类
$address =$email;

$mail->IsSMTP(); // 使用SMTP方式发送

$mail->Host = "smtp.qq.com"; // 您的企业邮局域名

$mail->SMTPAuth = true; // 启用SMTP验证功能

$mail->Username = "541232834@qq.com"; // 邮局用户名(请填写完整的email地址)

$mail->Password = "8327ZHE782yi"; // 邮局密码

$mail->Port=25;

$mail->From = "541232834@qq.com"; //邮件发送者email地址

$mail->FromName = "浪客剑心";

$mail->AddAddress("$address", $userName);//收件人地址，可以替换成任何想要接收邮件的email信箱,格式是AddAddress("收件人email","收件人姓名")




$mail->Subject = "请激活你的帐号，完成注册";//主题

$mail->Body = "尊敬的".$nickname."先生/女士:

欢迎加入宅不起!

请点击下面的链接完成注册：

http://localhost/zhaibuqi/zhaibuqi/php/register.php?p=$String

如果以上链接无法点击，请将上面的地址复制到你的浏览器(如IE)的地址栏进入宅不起。

感谢对宅不起的支持，再次希望您在宅不起的体验有益和愉快！

宅不起 http://www.zhaibuqi.com/
--宅不起

(这是一封自动产生的email，请勿回复.)";

$mail->AltBody = "This is the body in plain text for non-HTML mail clients"; //附加信息，可以省略



if(!$mail->Send())

{

    echo "邮件发送失败. <p>";

    echo "错误原因: " . $mail->ErrorInfo;

    exit;

}


$p=base64_encode($email.",".$domain_name);
//$p=$_COOKIE['a'].",".$domain_name;

$home_url = 'http://'. $_SERVER['HTTP_HOST'].dirname(dirname($_SERVER['PHP_SELF'])).'/register-confirm.php?p='.$p;
header('Location:'.$home_url);
//mysqli_close($dbc);

//echo "请到 ".$userName." 查阅来自豆瓣的邮件, 从邮件重设你的密码。";
//echo "<body/><html/>";
>>>>>>> 邮件系统
?>