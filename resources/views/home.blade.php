<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Growists Lab</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            text-align: center;
        }
        .btn {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background-color: #4f46e5;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #3730a3;
        }
    </style>
</head>
<body>
<div class="box">
    <h1>Bienvenido a Growists Lab</h1>
    @auth
        <a href="{{ route('student.challenges.index') }}" class="btn">Ir a Retos</a>
    @else
        <a href="{{ route('login') }}" class="btn">Iniciar Sesión</a>
        <a href="{{ route('register') }}" class="btn">Registrarse</a>
    @endauth
</div>
</body>
</html>
