@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
<div class="container-fluid">
    <!-- Header with Title and Dark Mode Toggle -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Product Dashboard</h1>
        <!-- Dark Mode Toggle Switch -->
        <div class="theme-toggle">
            <label class="theme-switch">
                <input type="checkbox" id="theme-toggle">
                <span class="theme-slider">
                    <i id="sun-icon" class="fa fa-sun"></i>
                    <i id="moon-icon" class="fa fa-moon"></i>
                </span>
            </label>
        </div>
    </div>
    
</div>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Dashboard Cards -->
    <div class="row">
        <!-- Products Card -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="small-box bg-info">
                <div class="inner">
                    <!-- Animated number counter -->
                    <h3 id="products-count">{{ $totalProducts }}</h3>
                    <p>Total Products</p>
                </div>
                <div class="icon">
                    <i class="fas fa-box"></i>
                </div>
                <a href="{{ route('admin.products.index') }}" class="small-box-footer">
                    Show More <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <!-- Users Card -->
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="small-box bg-success">
                <div class="inner">
                    <!-- Animated number counter -->
                    <h3 id="users-count">{{ $totalUsers }}</h3>
                    <p>Total Users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                    Show More <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row">
        <!-- Product Growth Chart -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Product Growth</h3>
                </div>
                <div class="card-body">
                    <canvas id="productChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>
        <!-- User Growth Chart -->
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User Growth</h3>
                </div>
                <div class="card-body">
                    <canvas id="userChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Custom CSS for the dark mode and toggle switch --}}
@section('css')
<style>
    /* Toggle Switch Styling */
    .theme-switch {
        position: relative;
        display: inline-block;
        width: 30px;
        height: 4px;
    }
    .theme-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    .theme-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }
    .theme-slider:before {
        position: absolute;
        content: "";
        height: 19px;
        width: 19px;
        left: 4px;
        bottom: 5px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }
    input:checked + .theme-slider {
        background-color: #2196F3;
    }
    input:checked + .theme-slider:before {
        transform: translateX(26px);
    }

    /* Dark Mode Overrides */
    body.dark-mode {
        background-color: #343a40;
        color: #c2c7d0;
    }
    body.dark-mode .small-box {
        background-color: #495057 !important;
        color: #c2c7d0;
    }
    body.dark-mode .small-box .icon i,
    body.dark-mode .small-box-footer {
        color: #c2c7d0;
    }
    body.dark-mode .card {
        background-color: #495057;
        color: #c2c7d0;
    }
    body.dark-mode .card-header {
        background-color: #3b3f44;
        color: #fff;
    }
    /* switsh */
    .theme-switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 30px;
}

.theme-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.theme-slider {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    border-radius: 50px;
    transition: 0.4s;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 5px;
}

.theme-slider i {
    color: #fff;
    font-size: 18px;
}

.theme-switch input:checked + .theme-slider {
    background-color: #333;
}

.theme-switch input:checked + .theme-slider i {
    display: block;
}

#moon-icon {
    display: none;
}

#sun-icon {
    display: block;
}

.theme-switch input:checked + .theme-slider #sun-icon {
    display: none;
}

.theme-switch input:checked + .theme-slider #moon-icon {
    display: block;
}


</style>
@endsection

@section('js')
<!-- Include Chart.js from a CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    /* =======================
       DARK MODE TOGGLE
    ========================= */
    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;
    const sunIcon = document.getElementById('sun-icon');
    const moonIcon = document.getElementById('moon-icon');
    const savedTheme = localStorage.getItem('theme') || 'light';

    if (savedTheme === 'dark') {
        body.classList.add('dark-mode');
        themeToggle.checked = true;
    }

    themeToggle.addEventListener('change', function () {
        if (this.checked) {
            body.classList.add('dark-mode');
            localStorage.setItem('theme', 'dark');
        } else {
            body.classList.remove('dark-mode');
            localStorage.setItem('theme', 'light');
        }
    });
    /* =======================
       ANIMATE NUMBER COUNTERS
    ========================= */
    function animateValue(id, start, end, duration) {
        const obj = document.getElementById(id);
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            obj.textContent = Math.floor(progress * (end - start) + start);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }
    // Animate the counts over 2 seconds (2000ms)
    animateValue("products-count", 0, {{ $totalProducts }}, 2000);
    animateValue("users-count", 0, {{ $totalUsers }}, 2000);

    /* =======================
       CHART.JS CONFIGURATIONS
    ========================= */
    // Product Growth Line Chart
    const productCtx = document.getElementById('productChart').getContext('2d');
    const productChart = new Chart(productCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Product Growth',
                data: [40, 55, 45, 65, 49, 60],
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.1,
                fill: true
            }]
        },
        options: {
            responsive: true,
            animation: {
                duration: 2000,
                easing: 'easeOutQuart'
            },
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // User Growth Bar Chart
    const userCtx = document.getElementById('userChart').getContext('2d');
    const userChart = new Chart(userCtx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'User Growth',
                data: [100, 120, 140, 160, 180, 200],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            animation: {
                duration: 2000,
                easing: 'easeOutQuart'
            },
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
</script>
@endsection
{{-- 
@section('content_header')
<div class="container-fluid">
    <!-- Header with Title and Dark Mode Toggle -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Product Dashboard</h1>
        <!-- Dark Mode Toggle Switch -->
        <div class="theme-toggle">
            <label class="theme-switch">
                <input type="checkbox" id="theme-toggle">
                <span class="theme-slider">
                    <i id="sun-icon" class="fa fa-sun"></i>
                    <i id="moon-icon" class="fa fa-moon"></i>
                </span>
            </label>
        </div>
    </div>
    
</div>
@endsection
//css
.theme-switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 30px;
}

.theme-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.theme-slider {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    border-radius: 50px;
    transition: 0.4s;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 5px;
}

.theme-slider i {
    color: #fff;
    font-size: 18px;
}

.theme-switch input:checked + .theme-slider {
    background-color: #333;
}

.theme-switch input:checked + .theme-slider i {
    display: block;
}

#moon-icon {
    display: none;
}

#sun-icon {
    display: block;
}

.theme-switch input:checked + .theme-slider #sun-icon {
    display: none;
}

.theme-switch input:checked + .theme-slider #moon-icon {
    display: block;
}
//js
document.addEventListener('DOMContentLoaded', function () {
    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;
    const sunIcon = document.getElementById('sun-icon');
    const moonIcon = document.getElementById('moon-icon');
    const savedTheme = localStorage.getItem('theme') || 'light';

    if (savedTheme === 'dark') {
        body.classList.add('dark-mode');
        themeToggle.checked = true;
    }

    themeToggle.addEventListener('change', function () {
        if (this.checked) {
            body.classList.add('dark-mode');
            localStorage.setItem('theme', 'dark');
        } else {
            body.classList.remove('dark-mode');
            localStorage.setItem('theme', 'light');
        }
    });
});


--}}
