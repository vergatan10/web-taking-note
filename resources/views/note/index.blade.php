@extends('partials.layout')

@section('content')
    <div class="row w-100">
        <div class="col-12 mb-4">
            <a href="{{ route('notes.create') }}" class="btn btn-primary">Add Note</a>
        </div>

        @foreach ($data as $key => $value)
            <div class="col-12 col-md-4 mb-4">
                <a href="{{ route('notes.edit', $value->id) }}" class="cursor-pointer text-decoration-none">
                    <div class="card">
                        <div class="card-body">
                            <p class="text-black">
                                {{ \Illuminate\Support\Str::limit($value->content, 100) }}
                                @if (strlen($value->content) > 100)
                                    <a href="{{ route('notes.detail', $value->id) }}">Read more</a>
                                @endif
                            </p>
                            <hr />
                            <div class="d-flex justify-content-between">
                                <div class="">
                                    <span class="me-1">
                                        <i
                                            class="icon-base bx bx-lock{{ $value->is_public ? '-open bg-success' : ' bg-info' }} text-black">
                                        </i>
                                    </span>
                                    <span><i class='icon-base bx bx-user'></i>
                                        {{ $value->shared_with_count ?? 0 }}</span>
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
        @endforeach
        {{ $data->links('pagination::bootstrap-5') }}

    </div>
@endsection
