<html>
<head>
    <title></title>
</head>
<body>
<form action="/values" method="POST">
    @csrf
    <pre>
        <input type="text" name="value_name"/>
        <br>

        <select name="attribute_id">
        <option></option>
        @foreach($value as $v)
                <option value="{{$v->id}}">{{$v->id}}</option>
            @endforeach
        </select>

        </pre>
    <input type="submit" name="submit"/>
</form>
</body>
</html>
