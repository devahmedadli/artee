@extends('layouts.admin')
@section('title', 'المستخدمين')
@section('content')

    <div class="card users-list overflow-auto">
        <!-- Card body -->
        <div class="card-body">
            <h5 class="card-title">قائمة المستخدمين <span>| الكل</span></h5>
            {{-- Add user button --}}
            <div>
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    إضافة مستخدم جديد
                </a>
            </div>
            <!-- Table with responsive wrapper -->
            <div class="table-responfsive">
                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>البريد الالكتروني</th>
                            <th>الاجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{-- <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                                    {{-- show --}}
                                    <a href="{{ route('users.edit', $user->id) }}" target="_blank" class="btn btn-info btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('Are you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
