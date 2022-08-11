<?php
function send_mail($mail_user,$mail_title,$mail_text) 
{
    global $conf;
    include_once ROOT."system/mail/class.phpmailer.php";
    include_once ROOT."system/mail/class.smtp.php";
    // 实例化PHPMailer核心类
    $mail = new PHPMailer();
    // 是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
    $mail->SMTPDebug = 0;
    // 使用smtp鉴权方式发送邮件
    $mail->isSMTP();
    // smtp需要鉴权 这个必须是true
    $mail->SMTPAuth = true;
    // 链接qq域名邮箱的服务器地址
    $mail->Host = $conf['mail_smtp'];
    // 设置使用ssl加密方式登录鉴权
    $mail->SMTPSecure = $conf['mail_encrypt'];
    // 设置ssl连接smtp服务器的远程服务器端口号
    $mail->Port = $conf['mail_port'];
    // 设置发送的邮件的编码
    $mail->CharSet = 'UTF-8';
    // 设置发件人昵称 显示在收件人邮件的发件人邮箱地址前的发件人姓名
    $mail->FromName = $conf['site_title'];
    // smtp登录的账号 QQ邮箱即可
    $mail->Username = $conf['mail_name'];
    // smtp登录的密码 使用生成的授权码
    $mail->Password = $conf['mail_pwd'];
    // 设置发件人邮箱地址 同登录账号
    $mail->From = $conf['mail_user'];
    // 邮件正文是否为html编码 注意此处是一个方法
    $mail->isHTML(true);
    // 设置收件人邮箱地址
    $mail->addAddress($mail_user);
    // 添加多个收件人 则多次调用方法即可
    //$mail->addAddress('87654321@163.com');
    // 添加该邮件的主题
    $mail->Subject = $mail_title;
    // 添加邮件正文
    $mail->Body = $mail_text;
    // 为该邮件添加附件
    //$mail->addAttachment('./1.zip');
    // 发送邮件 返回状态
    if($mail->send()) {
        return true;
    } else {
        return $mail->log;
    }
}
function send_mail_view($title,$text)
{
    global $conf,$DB;
    include_once ROOT."system/mail/view.php";
    $name = "send_mail_view_".$conf['mail_view'];
    $texts = $name($title,$text,$conf,$date);
    return $texts;
}
?>