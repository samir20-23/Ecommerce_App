<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photos - Index</title>
</head>

<body>
    <h1>Photo Index Page</h1>

    @foreach ($photos as $photo)
    <div>
        <h2>{{ $photo->title }}</h2>
        @if ($photo->trashed())
        <span>Deleted on {{ $photo->deleted_at }}</span>
        <form action="{{ route('photos.restore', $photo->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('POST') <!-- Explicitly set POST method -->
            <button type="submit">Restore</button>
        </form>
        @else
        <a href="{{ route('photos.show', $photo->id) }}">Show</a>
        <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
        @endif
    </div>
    @endforeach

</body>

</html>