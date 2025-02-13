@extends('layouts.admin')
@section('title', 'المستقلين')
@section('content')

    <div class="card freelancers-list overflow-auto">
        <!-- Card body -->
        <div class="card-body">
            <h5 class="card-title">قائمة المستقلين <span>| الكل</span></h5>
            {{-- Add freelancer button --}}
            <div>
                <a href="{{ route('freelancers.create') }}" class="btn btn-primary">
                    إضافة مستقل جديد
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
                        @foreach ($freelancers as $freelancer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $freelancer->name }}</td>
                                <td>{{ $freelancer->email }}</td>
                                <td>
                                    {{-- <a href="{{ route('freelancers.edit', $freelancer->id) }}" class="btn btn-warning ">Edit</a> --}}
                                    {{-- show --}}
                                    <a href="{{ route('freelancers.show', $freelancer) }}"
                                        class="btn btn-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('freelancers.edit', $freelancer) }}"
                                        class="btn btn-info ">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('freelancers.destroy', $freelancer) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('Are you want to delete this freelancer?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger ">
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
