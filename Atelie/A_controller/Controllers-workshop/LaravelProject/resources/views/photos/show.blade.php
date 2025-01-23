<h1>{{ $photo->title }}</h1>
@if ($photo->trashed())
    <span>Deleted on {{ $photo->deleted_at }}</span>
    <a href="{{ route('photos.restore', $photo->id) }}">Restore</a>
@endif