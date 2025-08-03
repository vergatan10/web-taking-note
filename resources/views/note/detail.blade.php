@extends('partials.layout')

@section('content')
    <div class="row w-100">
        <div class="col-12 mb-4">
            <a href="{{ route('home') }}" class="btn btn-warning">Back</a>
        </div>
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title">Detail Note</h5>
                    <div>
                        <span
                            class="badge bg-label-{{ $note->is_public ? 'success' : 'info' }}">{{ $note->is_public ? 'Public' : 'Private' }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        <div>{{ $note->content }}</div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span class="badge bg-label-primary me-1">Owner:
                            {{ $note->owner->name == auth()->user()->name ? 'You' : $note->owner->name }}</span>
                        <span class="text-muted">{{ $note->created_at->format('d M Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12 mb-6 mb-xl-0">
                        <small class="fw-medium text-">Komentar</small>
                        <hr />
                        <div class="demo-inline-spacing mt-4">
                            <div class="list-group list-group-flush">
                                @forelse ($note->comments as $comment)
                                    <span class="list-group-item list-group-item-action">
                                        <strong>{{ $comment->user->name ?? 'Anonim' }}:</strong>
                                        {{ $comment->comment }}
                                        <small style="color: gray">({{ $comment->created_at->diffForHumans() }})</small>
                                    </span>
                                @empty
                                    <span class="list-group-item list-group-item-action">Belum ada komentar.</span>
                                @endforelse
                            </div>
                        </div>
                        <hr />
                        <form action="{{ route('notes.comment', $note->id) }}" method="POST" class="mt-3">
                            @csrf
                            <div class="mb-3">
                                <label for="comment" class="form-label">Tulis Komentar</label>
                                <textarea class="form-control" id="comment" name="comment" rows="2" required></textarea>
                                @error('comment')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
