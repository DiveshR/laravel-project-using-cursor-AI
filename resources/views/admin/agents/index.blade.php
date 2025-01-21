@extends('admin.layouts.app')

@section('title', 'Agents List')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Agents List</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.agents.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Add New Agent
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible m-3">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($agents as $agent)
                            <tr>
                                <td>{{ $agent->id }}</td>
                                <td>{{ $agent->name }}</td>
                                <td>{{ $agent->email }}</td>
                                <td>{{ $agent->phone_number }}</td>
                                <td>
                                    <span class="badge badge-{{ $agent->status === 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($agent->status) }}
                                    </span>
                                </td>
                                <td>{{ $agent->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('admin.agents.edit', $agent) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.agents.destroy', $agent) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this agent?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No agents found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($agents->hasPages())
                <div class="card-footer clearfix">
                    <div class="float-right">
                        {{ $agents->links('admin.vendor.pagination.adminlte') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.pagination {
    margin: 0;
}
.page-link {
    padding: .5rem .75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #007bff;
    background-color: #fff;
    border: 1px solid #dee2e6;
}
.page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}
.page-item.disabled .page-link {
    color: #6c757d;
    pointer-events: none;
    cursor: auto;
    background-color: #fff;
    border-color: #dee2e6;
}
</style>
@endpush