@extends('template.temp_admin')

@section('content')
    @if (session('status'))
        <div class="toast toast-top toast-start">
            <div class="alert alert-success">
                <span>{{ session('status') }}</span>
            </div>
        </div>
    @endif

    <div class="modal" role="dialog" id="my_modal_crt">
        <div class="modal-box">
            <h3 class="font-bold text-lg">Create role</h3>
            <form method="post" action="/post-role" class="flex flex-col">
                @csrf
                <div class="flex gap-2">
                    <div class="flex flex-col gap-2 w-full">
                        <span class="mt-1">Name</span>
                        <input class="input input-bordered w-full" type="text" name="name">
                    </div>
                </div>
                <div class="flex justify-between mt-2">
                    <button type="submit" class="btn btn-success mt-2 rounded-lg">Submit</button>
                    <a href="#" type="submit" class="btn btn-error mt-2 rounded-lg">close</a>
            </form>
        </div>
    </div>
    </div>

    <main class="flex flex-1 flex-col gap-4 p-4 md:gap-8 md:p-6">
        <div class="flex items-center">
            <h1 class="font-semibold text-lg md:text-2xl">Roles</h1>
            <a href="#my_modal_crt"
                class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-9 rounded-md px-3 ml-auto">
                Add role
            </a>
        </div>
        <div class="border shadow-lg rounded-lg">
            <div class="relative w-full overflow-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-lg">Name</th>
                            <th class="text-center text-lg">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <div class="modal" role="dialog" id="my_modal_edt_{{ $role->id }}">
                                <div class="modal-box">
                                    <h3 class="font-bold text-lg">Edit user</h3>
                                    <form method="post" action="/put-role/{{ $role->id }}" class="flex flex-col">
                                        @csrf
                                        @method('PUT')
                                        <div class="flex flex-col gap-2">
                                            <span>name</span>
                                            <input class="input input-bordered" type="text" name="name"
                                                value="{{ $role->name }}">
                                        </div>
                                        <div class="flex justify-between">
                                            <button type="submit" class="btn btn-success mt-2 rounded-lg">Submit</button>
                                            <a href="#" type="submit" class="btn btn-error mt-2 rounded-lg">close</a>
                                    </form>
                                </div>
                            </div>
            </div>

            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        <div>
                            <div class="font-bold">{{ $role->name }}
                            </div>
                        </div>
                    </div>
                </td>
                <th>
                    <div class="flex w-full justify-center gap-2">
                        <a href="#my_modal_edt_{{ $role->id }}" class="btn btn-warning rounded-lg">Edit</a>
                        <form action="/destroy-role/{{ $role->id }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-error rounded-lg">Delete</button>
                        </form>
                    </div>

                </th>
            </tr>
            @endforeach
            </tbody>

            </table>
        </div>
        </div>
    </main>
@endsection
