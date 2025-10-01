@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Theme Settings</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.theme-settings.update') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="primary_color" class="form-label">Primary Color</label>
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" id="primary_color" name="primary_color" value="{{ $colors['primary_color'] }}">
                                        <input type="text" class="form-control" value="{{ $colors['primary_color'] }}" readonly>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="secondary_color" class="form-label">Secondary Color</label>
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" id="secondary_color" name="secondary_color" value="{{ $colors['secondary_color'] }}">
                                        <input type="text" class="form-control" value="{{ $colors['secondary_color'] }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="text_color" class="form-label">Text Color</label>
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" id="text_color" name="text_color" value="{{ $colors['text_color'] }}">
                                        <input type="text" class="form-control" value="{{ $colors['text_color'] }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="link_color" class="form-label">Link Color</label>
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" id="link_color" name="link_color" value="{{ $colors['link_color'] }}">
                                        <input type="text" class="form-control" value="{{ $colors['link_color'] }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="header_bg_color" class="form-label">Header Background Color</label>
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" id="header_bg_color" name="header_bg_color" value="{{ $colors['header_bg_color'] }}">
                                        <input type="text" class="form-control" value="{{ $colors['header_bg_color'] }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sidebar_bg_start" class="form-label">Sidebar Gradient Start</label>
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" id="sidebar_bg_start" name="sidebar_bg_start" value="{{ $colors['sidebar_bg_start'] }}">
                                        <input type="text" class="form-control" value="{{ $colors['sidebar_bg_start'] }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="sidebar_bg_end" class="form-label">Sidebar Gradient End</label>
                                    <div class="input-group">
                                        <input type="color" class="form-control form-control-color" id="sidebar_bg_end" name="sidebar_bg_end" value="{{ $colors['sidebar_bg_end'] }}">
                                        <input type="text" class="form-control" value="{{ $colors['sidebar_bg_end'] }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="preview-section mt-4 mb-4">
                            <h4>Preview</h4>
                            <div class="preview-box p-3 border rounded" style="background: linear-gradient(to right, var(--sidebar-bg-start), var(--sidebar-bg-end));">
                                <h5 style="color: var(--text-color)">Sample Text</h5>
                                <a href="#" style="color: var(--link-color)">Sample Link</a>
                                <button class="btn mt-2" style="background-color: var(--primary-color); color: white;">Primary Button</button>
                                <button class="btn mt-2" style="background-color: var(--secondary-color); color: white;">Secondary Button</button>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const colorInputs = document.querySelectorAll('input[type="color"]');
    
    colorInputs.forEach(input => {
        input.addEventListener('input', function() {
            // Update the text input next to the color picker
            this.nextElementSibling.value = this.value;
            
            // Update the CSS variable for live preview
            document.documentElement.style.setProperty(
                `--${this.id.replace(/_/g, '-')}`, 
                this.value
            );
        });
    });
});
</script>
@endpush
@endsection