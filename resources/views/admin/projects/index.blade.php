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
                                                <!-- Modal trigger button -->
                                                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal"
                                                    data-bs-target="#modalId-{{ $project->id }}">
                                                    delete
                                                </button>

                                                <!-- Modal Body -->
                                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                                <div class="modal fade" id="modalId-{{ $project->id }}" tabindex="-1"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                                    aria-labelledby="modalTitleId" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                        role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalTitleId">Modal title</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Body
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <form
                                                                    action="{{ route('admin.projects.destroy', $project->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-primary">delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Optional: Place to the bottom of scripts -->
                                                <script>
                                                    const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
                                                </script>

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
