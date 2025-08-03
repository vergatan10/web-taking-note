@extends('partials.layout')

@section('content')
    <div class="row w-100 mb-3">
        <div class="col-12 d-flex justify-content-end">
            <form method="GET" action="{{ route('home') }}" class="d-flex align-items-center">
                <label for="filter" class="me-2 mb-0">Tampilkan</label>
                <select name="filter" id="filter" class="form-select form-select-sm me-2" onchange="this.form.submit()">
                    <option value="" {{ request('filter') == '' ? 'selected' : '' }}>Semua</option>
                    <option value="shared" {{ request('filter') == 'shared' ? 'selected' : '' }}>Shared</option>
                    <option value="public" {{ request('filter') == 'public' ? 'selected' : '' }}>Public</option>
                </select>
                <noscript><button type="submit" class="btn btn-sm btn-primary">Terapkan</button></noscript>
            </form>
        </div>
    </div>
    <div class="row w-100">
        @if (session('error'))
            <div class="col-12">
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            </div>
        @endif
        @forelse ($data as $key => $value)
            <div class="col-12 col-md-4 mb-4">
                <a href="{{ route('notes.detail', $value->id) }}" class="cursor-pointer text-decoration-none">
                    <div class="card">
                        <div class="card-body">
                            <p class="text-black">
                                {{ \Illuminate\Support\Str::limit($value->content, 100) }}
                                @if (strlen($value->content) > 100)
                                    <a href="{{ route('notes.detail', $value->id) }}">Read more</a>
                                @endif
                                {{-- {{ $value->content }} --}}
                            </p>
                            <hr />
                            <div class="d-flex justify-content-between">
                                <div class="">
                                    @if ($value->is_public == 0)
                                        <span class="me-1">
                                            <i class="icon-base bx bx-lock bg-info text-black">
                                            </i>
                                        </span>
                                    @endif
                                    <span class="badge bg-label-primary me-1">{{ $value->owner->name }}</span>
                                    <span><i class="icon-base bx bx-message-dots me-1">
                                        </i>{{ $value->comments_count ?? 0 }}</span>
                                </div>
                                <span class="text-black"
                                    style="font-size: 12px">{{ $value->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-12 d-flex justify-content-center mt-4">
                <p>Empty data</p>
            </div>
        @endforelse
        {{ $data->links('pagination::bootstrap-5') }}
    </div>
@endsection
