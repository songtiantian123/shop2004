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
    <table border="1">
        <tr>
            <td>编码</td>
            <td>姓名</td>
            <td>性别</td>
            <td>年龄</td>
            <td>班级</td>
            <td>操作</td>
        </tr>
        @foreach($studentInfo as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->name}}</td>
            <td>{{$v->sex==1?'男':'女'}}</td>
            <td>{{$v->age}}</td>
            <td>{{$v->class_id}}</td>
            <td>
                <a href="{{url('student/edit/'.$v->id)}}">
                    <button type="button" class="btn btn-primary">编辑</button>
                </a>
                <a href="{{url('student/destroy/'.$v->id)}}">
                    <button type="button" class="btn btn-primary">删除</button>
                </a>
            </td>
        </tr>
            @endforeach
    </table>
</form>
</body>
</html>







