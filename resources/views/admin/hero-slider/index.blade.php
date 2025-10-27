@extends('admin.layouts.app')

@section('title', 'Manage Hero Slider')

@section('styles')
<style>
    .slider-preview {
        width: 200px;
        height: 120px;
        object-fit: cover;
        border-radius: 8px;
    }
    .drag-handle {
        cursor: move;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Manage Hero Slider</h1>
        <a href="{{ route('admin.hero-slider.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>Add New Slide
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($slides->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="10"></th>
                                <th width="200">Image</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th width="100">Status</th>
                                <th width="150">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="sortable-slides">
                            @foreach($slides as $slide)
                                <tr data-id="{{ $slide->id }}">
                                    <td>
                                        <i class="bi bi-grip-vertical drag-handle"></i>
                                    </td>
                                    <td>
                                        <img src="{{ asset($slide->image_path) }}" 
                                             alt="{{ $slide->title }}" 
                                             class="slider-preview">
                                    </td>
                                    <td>{{ $slide->title }}</td>
                                    <td>{{ $slide->subtitle }}</td>
                                    <td>
                                        <span class="badge bg-{{ $slide->is_active ? 'success' : 'danger' }}">
                                            {{ $slide->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.hero-slider.edit', $slide) }}" 
                                           class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.hero-slider.destroy', $slide) }}" 
                                              method="POST" 
                                              class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Are you sure you want to delete this slide?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="bi bi-images" style="font-size: 3rem;"></i>
                    <p class="mt-3">No slider images added yet.</p>
                    <a href="{{ route('admin.hero-slider.create') }}" class="btn btn-primary">
                        Add Your First Slide
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const sortable = new Sortable(document.getElementById('sortable-slides'), {
        handle: '.drag-handle',
        animation: 150,
        onEnd: function() {
            const rows = document.querySelectorAll('#sortable-slides tr');
            const orders = {};
            
            rows.forEach((row, index) => {
                orders[row.dataset.id] = index;
            });

            // Update order in database
            fetch('{{ route("admin.hero-slider.update-order") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ orders })
            });
        }
    });
});
</script>
@endsection