<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登录</title>
</head>
<body>
<form action="{{url('/user/loginDo')}}" method="post">
  <table>
      <tr>
          <td>用户名</td>
          <td><input type="text" name="last_login"></td>
      </tr>
      <tr>
          <td>密码</td>
          <td><input type="password" name="password"></td>
      </tr>
      <tr>
          <td></td>
          <td>
              <input type="submit" value="登录">
              <input type="reset" value="重置">
          </td>
      </tr>
  </table>
</form>
</body>
</html>







