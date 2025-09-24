@extends('admin.layouts.app')

@section('title', 'Company Information')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Company Information</h1>
    <small class="text-muted">Manage dynamic content for your website</small>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h5><i class="bi bi-info-circle"></i> Website Content Settings</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.company-info.update') }}">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-primary mb-3">Homepage Content</h6>
                    
                    <div class="mb-3">
                        <label for="hero_title" class="form-label">Hero Section Title</label>
                        <input type="text" class="form-control @error('hero_title') is-invalid @enderror" 
                               id="hero_title" name="hero_title" 
                               value="{{ $companyInfo->get('hero_title')?->value ?? $fields['hero_title']['default'] }}"
                               placeholder="{{ $fields['hero_title']['default'] }}">
                        @error('hero_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="hero_subtitle" class="form-label">Hero Section Subtitle</label>
                        <textarea class="form-control @error('hero_subtitle') is-invalid @enderror" 
                                  id="hero_subtitle" name="hero_subtitle" rows="3"
                                  placeholder="{{ $fields['hero_subtitle']['default'] }}">{{ $companyInfo->get('hero_subtitle')?->value ?? $fields['hero_subtitle']['default'] }}</textarea>
                        @error('hero_subtitle')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <h6 class="text-primary mb-3">About Us Content</h6>
                    
                    <div class="mb-3">
                        <label for="about_us" class="form-label">About Us Description</label>
                        <textarea class="form-control @error('about_us') is-invalid @enderror" 
                                  id="about_us" name="about_us" rows="4"
                                  placeholder="{{ $fields['about_us']['default'] }}">{{ $companyInfo->get('about_us')?->value ?? $fields['about_us']['default'] }}</textarea>
                        @error('about_us')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-primary mb-3">Mission & Vision</h6>
                    
                    <div class="mb-3">
                        <label for="mission" class="form-label">Mission Statement</label>
                        <textarea class="form-control @error('mission') is-invalid @enderror" 
                                  id="mission" name="mission" rows="3"
                                  placeholder="{{ $fields['mission']['default'] }}">{{ $companyInfo->get('mission')?->value ?? $fields['mission']['default'] }}</textarea>
                        @error('mission')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="vision" class="form-label">Vision Statement</label>
                        <textarea class="form-control @error('vision') is-invalid @enderror" 
                                  id="vision" name="vision" rows="3"
                                  placeholder="{{ $fields['vision']['default'] }}">{{ $companyInfo->get('vision')?->value ?? $fields['vision']['default'] }}</textarea>
                        @error('vision')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="experience" class="form-label">Experience Description</label>
                        <textarea class="form-control @error('experience') is-invalid @enderror" 
                                  id="experience" name="experience" rows="2"
                                  placeholder="{{ $fields['experience']['default'] }}">{{ $companyInfo->get('experience')?->value ?? $fields['experience']['default'] }}</textarea>
                        @error('experience')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <h6 class="text-primary mb-3">Contact Information</h6>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">Business Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                  id="address" name="address" rows="3"
                                  placeholder="{{ $fields['address']['default'] }}">{{ $companyInfo->get('address')?->value ?? $fields['address']['default'] }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" name="phone" 
                               value="{{ $companyInfo->get('phone')?->value ?? $fields['phone']['default'] }}"
                               placeholder="{{ $fields['phone']['default'] }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" 
                               value="{{ $companyInfo->get('email')?->value ?? $fields['email']['default'] }}"
                               placeholder="{{ $fields['email']['default'] }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="business_hours" class="form-label">Business Hours</label>
                        <input type="text" class="form-control @error('business_hours') is-invalid @enderror" 
                               id="business_hours" name="business_hours" 
                               value="{{ $companyInfo->get('business_hours')?->value ?? $fields['business_hours']['default'] }}"
                               placeholder="{{ $fields['business_hours']['default'] }}">
                        @error('business_hours')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <hr>

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-check-circle"></i> Save Changes
                    </button>
                    <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-secondary">
                        <i class="bi bi-eye"></i> Preview Website
                    </a>
                </div>
                <small class="text-muted">
                    <i class="bi bi-info-circle"></i>
                    Changes will be reflected immediately on your website
                </small>
            </div>
        </form>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-light">
                <h6><i class="bi bi-lightbulb"></i> Tips</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success"></i>
                        Keep your hero title concise and impactful
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success"></i>
                        Use your hero subtitle to explain your value proposition
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success"></i>
                        Update contact information regularly
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success"></i>
                        Make sure your mission and vision align with your business
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-light">
                <h6><i class="bi bi-gear"></i> Current Settings Status</h6>
            </div>
            <div class="card-body">
                @php
                    $completedFields = $companyInfo->filter(function($info) { return !empty($info->value); })->count();
                    $totalFields = count($fields);
                    $percentage = $totalFields > 0 ? round(($completedFields / $totalFields) * 100) : 0;
                @endphp
                
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <span>Profile Completion:</span>
                        <span class="fw-bold">{{ $completedFields }}/{{ $totalFields }} ({{ $percentage }}%)</span>
                    </div>
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%"></div>
                    </div>
                </div>

                <small class="text-muted">
                    Complete all fields to maximize your website's effectiveness.
                </small>
            </div>
        </div>
    </div>
</div>
@endsection