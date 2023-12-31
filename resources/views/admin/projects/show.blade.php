@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <div class="row align-items-md-stretch">
            <div class="col-md-12 h-100 p-5 text-white bg-primary border rounded-3">
                <div class="row">
                    <div class="col-6">
                        <h2>{{ $project->title }}</h2>
                        <p>{{ $project->content }}</p>

                    </div>
                    <div class="col-6">
                        @if ($project->cover_image)
                            <img class="img-fluid" src="{{ asset('storage/placeholders/' . $project->cover_image) }}"
                                alt="">
                        @endif
                    </div>
                </div>

            </div>

        </div>
        <div class="row mt-4">
            <div class="col-4 m-auto text-center">
                <a class="btn btn-info text-white" href="{{ route('admin.projects.index') }}">
                    <i class="fa-solid fa-arrow-left"></i></a>
            </div>
        </div>
    </div>

    </div>
@endsection
