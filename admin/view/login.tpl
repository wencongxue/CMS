<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <link rel="stylesheet" href="{getRootDir()}/public/css/bootstrap3/css/bootstrap.css">
    <link rel="stylesheet" href="{getRootDir()}/public/css/login.css">
</head>
<body>
    <form method="post" action="{makeUrl('Login','index')}">
        <div class="form-group">
            <label for="username">用户名：</label>
            <input type="input" class="form-control" id="username" name="username" placeholder="请输入用户名">
            <label for="password">密码:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="请输入密码">
            <input type="submit" class="btn-primary submit" value="登录">
        </div>
    </form>
</body>
<script src="{getRootDir()}/public/js/login.js"></script>
</html>
