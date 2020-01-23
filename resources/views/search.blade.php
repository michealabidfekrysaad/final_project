<html>
<head>
<title>Seacrh</title>
</head>
<body>
    <form action="/search" method="POST">
    @csrf
    <input type="text" name="search" />
    <input type="submit" name="submit"/>
    </form>
</body>
</html>