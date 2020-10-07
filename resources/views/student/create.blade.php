<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{url('/student/store')}}" method="post">
    @csrf
    <table>
        <tr>
            <td>姓名</td>
            <td><input type="text" name="name"></td>
        </tr>
        <tr>
            <td>性别</td>
            <td>
                <input type="radio" name="sex" value="1" checked>男
                <input type="radio" name="sex" value="1">女
            </td>
        </tr>
        <tr>
            <td>年龄</td>
            <td><input type="text" name="age"></td>
        </tr>
        <tr>
            <td>班级</td>
            <td>
                <select name="class_id">
                    <option value="">--请选择--</option>
                    <option value="2">3</option>
                </select>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="添加"></td>
        </tr>
    </table>
</form>
</body>
</html>
