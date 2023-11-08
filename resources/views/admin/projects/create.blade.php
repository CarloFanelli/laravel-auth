@extends('layouts.admin')

@section('content')
    <h1>new project</h1>

    @if ($errors->any())
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Alert</strong>
            <ul>

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">

            <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="title"
                        aria-describedby="helperTitle">
                    <small id="helperTitle" class="text-muted">type your post title max:50 characters</small>
                </div>

                <div class="mb-3">
                    <label for="cover_image" class="form-label">Choose file</label>
                    <input type="file" class="form-control" name="cover_image" id="cover_image"
                        placeholder="choose a file" aria-describedby="fileHelp">
                    <div id="fileHelp" class="form-text">add an image max 500kb</div>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">content</label>
                    <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

    </div>
@endsection
