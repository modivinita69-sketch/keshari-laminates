<style>
{!! \App\Models\ThemeSetting::generateCssVariables() !!}

/* Apply theme colors */
.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.btn-secondary {
    background-color: var(--secondary-color);
    border-color: var(--secondary-color);
}

.text-primary {
    color: var(--primary-color) !important;
}

.text-secondary {
    color: var(--secondary-color) !important;
}

a {
    color: var(--link-color);
}

/* Sidebar styling */
.sidebar {
    background: linear-gradient(to bottom, var(--sidebar-bg-start), var(--sidebar-bg-end));
}

.sidebar .nav-link {
    color: rgba(255, 255, 255, 0.8);
}

.sidebar .nav-link:hover,
.sidebar .nav-link.active {
    color: #ffffff;
    background-color: rgba(255, 255, 255, 0.1);
}

/* Header styling */
.navbar {
    background-color: var(--header-bg-color);
}

/* Text colors */
body {
    color: var(--text-color);
}

/* Form controls */
.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(var(--primary-color-rgb), 0.25);
}
</style>