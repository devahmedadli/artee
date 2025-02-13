@extends('layouts.admin')
@section('title', __('Contact Messages'))
@section('content')

    <div class="card contact-messages-list overflow-auto">
        <!-- Card body -->
        <div class="card-body">
            <h5 class="card-title">{{ __('Contact Messages List') }} <span>| {{ __('All') }}</span></h5>
            
            <!-- Table with responsive wrapper -->
            <div class="table-responsive">
                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Sent Date') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contactMessages as $message)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#showModal{{ $message->id }}">
                                        {{ __('View Details') }}
                                    </button>
                                </td>
                            </tr>

                            <!-- Show Modal -->
                            <div class="modal fade" id="showModal{{ $message->id }}" tabindex="-1"
                                aria-labelledby="showModalLabel{{ $message->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="showModalLabel{{ $message->id }}">{{ __('Message Details') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <strong>{{ __('Name') }}:</strong> {{ $message->name }}
                                            </div>
                                            <div class="mb-3">
                                                <strong>{{ __('Email') }}:</strong> {{ $message->email }}
                                            </div>
                                            <div class="mb-3">
                                                <strong>{{ __('Subject') }}:</strong> {{ $message->subject }}
                                            </div>
                                            <div class="mb-3">
                                                <strong>{{ __('Sent Date') }}:</strong> {{ $message->created_at->format('Y-m-d H:i') }}
                                            </div>
                                            <div class="mb-3">
                                                <strong>{{ __('Message') }}:</strong>
                                                <br>
                                                <p>{!! nl2br(e($message->message)) !!}</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
