/* Generated theme variables */
{!! \App\Models\ThemeSetting::generateCssVariables() !!}

/* Utility classes for theme colors */
:root {
    --color-white: #ffffff;
    --color-black: #000000;
    --gradient-primary: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    --gradient-secondary: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
}

/* Background Colors */
.bg-primary {
    background-color: var(--primary-color) !important;
}

.bg-secondary {
    background-color: var(--secondary-color) !important;
}

.bg-gradient-primary {
    background: var(--gradient-primary) !important;
}

.bg-gradient-secondary {
    background: var(--gradient-secondary) !important;
}

/* Text Colors */
.text-primary {
    color: var(--primary-color) !important;
}

.text-secondary {
    color: var(--secondary-color) !important;
}

/* Border Colors */
.border-primary {
    border-color: var(--primary-color) !important;
}

.border-secondary {
    border-color: var(--secondary-color) !important;
}

/* Button styles */
.btn-primary,
.btn-primary-orange {
    position: relative;
    background: var(--gradient-primary);
    border: none;
    color: var(--color-white);
    transition: all 0.3s ease;
    z-index: 1;
    overflow: hidden;
}

.btn-primary::before,
.btn-primary-orange::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--gradient-secondary);
    z-index: -1;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.btn-primary:hover::before,
.btn-primary-orange:hover::before {
    opacity: 1;
}

.btn-secondary {
    background: var(--gradient-secondary);
    border: none;
    color: var(--color-white);
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: var(--gradient-primary);
    transform: translateY(-2px);
}

/* Section title styles */
.section-title {
    position: relative;
    color: var(--primary-color);
    font-weight: bold;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background: var(--gradient-primary);
}

/* Category styles */
.category-icon {
    background: var(--gradient-primary);
    transition: background 0.3s ease;
}

.category-card:hover .category-icon {
    background: var(--gradient-secondary);
}

/* Statistics section styles */
.stats-section {
    background: linear-gradient(135deg, 
        rgba(var(--primary-color-rgb), 0.1),
        rgba(var(--secondary-color-rgb), 0.1)
    );
}

.stat-number {
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Link styles */
a {
    color: var(--link-color);
    transition: color 0.3s;
}

a:hover {
    color: var(--secondary-color);
}