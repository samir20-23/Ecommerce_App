<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitors</title>
</head>
<body>
    <h1>Visitors List</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Age</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Active</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visitors as $visitor)
            <tr>
                <td>{{ $visitor->id }}</td>
                <td>{{ $visitor->age }}</td>
                <td>{{ $visitor->name }}</td>
                <td>{{ $visitor->email }}</td>
                <td>{{ $visitor->created_at }}</td>
                <td>{{ $visitor->active }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
