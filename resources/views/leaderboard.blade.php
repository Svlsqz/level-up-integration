<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard - Growists Lab</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { padding: 0.75rem; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f5f5f5; }
    </style>
</head>
<body>
<h1>🌟 Leaderboard - Top 10 Estudiantes</h1>

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>XP</th>
        <th>Nivel</th>
    </tr>
    </thead>
    <tbody>
    @foreach($topUsers as $index => $user)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->getPoints() }}</td>
            <td>{{ $user->getLevel() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
