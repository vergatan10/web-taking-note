@extends('partials.layout')

@section('content')
    <div class="row w-100">
        <div class="col-12 mb-4">
            <a href="{{ route('notes') }}" class="btn btn-warning">Back</a>
        </div>
        <div class="col-12 col-md-7 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title">{{ $method == 'PUT' ? 'Edit Note' : 'Add Note' }}</h5>
                    <div>
                        @if ($method == 'PUT')
                            <a href="{{ route('notes.detail', $data->id) }}" class="btn btn-sm btn-success">Detail</a>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ $action }}" method="POST">
                        @csrf
                        @method($method == 'PUT' ? 'PUT' : 'POST')
                        <div class="form-group mb-3">
                            <label for="content">Note</label>
                            <textarea class="form-control" id="content" name="content" cols="30" rows="10">{{ $data->content }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="is_public">Public</label>
                            <select class="form-control" id="is_public" name="is_public">
                                <option value="1" {{ $data->is_public ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !$data->is_public ? 'selected' : '' }}>No</option>
                            </select>
                            <small class="text-muted">Jika <i>public</i>, note dapat dilihat oleh semua user.</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        @if ($data->id)
                            <a href="{{ route('notes.destroy', $data->id) }}" class="btn btn-danger"
                                onclick="return confirm('Yakin ingin menghapus catatan ini?')">Delete</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="icon-base bx bx-user bg-info"></i> Bagikan Catatan Kepada User Lain
                    </h5>
                    @if ($data->id)
                        @if ($data->is_public == 0)
                            <form action="{{ route('notes.share', $data->id) }}" method="POST" class="mb-3">
                                @csrf
                                <div class="form-group mb-2">
                                    <label for="user_id">Pilih User untuk Sharing</label>
                                    <select class="form-control" id="user_id" name="user_id" required>
                                        <option value="">-- Pilih User --</option>
                                        @foreach ($users as $user)
                                            @if ($user->id != auth()->id())
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success btn-sm">Bagikan</button>
                            </form>
                            <h6 class="mt-4">Sudah Dibagikan Kepada:</h6>
                            <div class="list-group">
                                @forelse ($data->sharedWith as $item)
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $item->name }}
                                        <form action="{{ route('notes.unshare', [$data->id]) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus akses"
                                                onclick="return confirm('Yakin ingin menghapus akses user ini?')">Hapus</button>
                                        </form>
                                    </div>
                                @empty
                                    <div class="list-group-item text-muted">Belum dibagikan ke siapa pun.</div>
                                @endforelse
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <h6 class="alert-heading">Warning!</h6>
                                <p>Anda belum membuat catatan publik. Silahkan buat catatan publik terlebih dahulu.</p>
                            </div>
                        @endif
                    @else
                        <div class="alert alert-warning">
                            <h6 class="alert-heading">Warning!</h6>
                            <p>Anda belum membuat catatan. Silahkan buat catatan terlebih dahulu.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
