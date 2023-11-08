@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="user_welcome">
                            {{ Auth::user()->name }} {{ __('Dashboard') }}.

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            {{ __('You are logged in!') }}
                        </div>
                        <div class="controls">
                            <a class="btn btn-info text-white" href="{{ route('admin.projects.create') }}">AddNew</a>
                            <a class="btn btn-danger text-white" href="{{ route('admin.projects.create') }}">Trashed</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class="table table-striped
                            table-hover	
                            table-borderless
                            table-primary
                            align-middle">
                                <thead class="table-light">
                                    <caption>All Projects</caption>
                                    <tr>
                                        <th>ID</th>
                                        <th>TITLE</th>
                                        <th>SLUG</th>
                                        <th>IMG</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @forelse ($projects as $project)
                                        <tr class="table-primary">
                                            <td scope="row">{{ $project->id }}</td>
                                            <td>{{ $project->title }}</td>
                                            <td>{{ $project->slug }}</td>
                                            <td>
                                                @if ($project->cover_image)
                                                    <img class="img-fluid w-50"
                                                        src="{{ asset('storage/placeholders/' . $project->cover_image) }}"
                                                        alt="">
                                                @endif
                                            </td>
                                            <td>

                                                <a href="{{ route('admin.projects.show', $project->id) }}">show</a>
                                                <a href="{{ route('admin.projects.edit', $project->id) }}">edit</a>

                                            </td>
                                        </tr>
                                    @empty
                                        <h1>no projects here!</h1>
                                    @endforelse



                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
