@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Dashboard</title>
        <!-- Tailwind CSS -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <style>
            /* Custom switch styling */
            .theme-switch {
                position: relative;
                display: inline-block;
                width: 60px;
                height: 34px;
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
                height: 26px;
                width: 26px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                transition: .4s;
                border-radius: 50%;
            }

            input:checked+.theme-slider {
                background-color: #2196F3;
            }

            input:checked+.theme-slider:before {
                transform: translateX(26px);
            }
        </style>
    </head>

    <body class="bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
        <div class="container mx-auto px-4 py-8">
            <!-- Dark Mode Toggle -->
            <div class="flex justify-end mb-6">
                <label class="theme-switch">
                    <input type="checkbox" id="theme-toggle">
                    <span class="theme-slider"></span>
                </label>
            </div>

            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Products Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transform transition-all hover:scale-105">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-gray-500 dark:text-gray-300 text-sm uppercase">Total Products</h3>
                            <p id="total-products" class="text-3xl font-bold dark:text-white">{{ $totalProducts }}</p>
                        </div>
                        <i class="fas fa-box text-blue-500 text-4xl"></i>
                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-green-500 text-sm">
                            <i class="fas fa-arrow-up"></i> 15.6% from last month
                        </span>
                        <a href="{{ route('admin.products.index') }}"
                            class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition">
                            Show More
                        </a>
                    </div>
                </div>

                <!-- Total Users Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transform transition-all hover:scale-105">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-gray-500 dark:text-gray-300 text-sm uppercase">Total Users</h3>
                            <p id="total-users" class="text-3xl font-bold dark:text-white">{{ $totalUsers }}</p>
                        </div>
                        <i class="fas fa-users text-green-500 text-4xl"></i>
                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-green-500 text-sm">
                            <i class="fas fa-arrow-up"></i> 18.2% from last month
                        </span>
                        
                        <a href="{{ route('admin.users.index') }}"
                            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">
                            Show More
                        </a>
                    </div>
                </div>

                <!-- Monthly Revenue Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 transform transition-all hover:scale-105">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-gray-500 dark:text-gray-300 text-sm uppercase">Monthly Revenue</h3>
                            <p id="monthly-revenue" class="text-3xl font-bold dark:text-white">$45,678</p>
                        </div>
                        <i class="fas fa-dollar-sign text-purple-500 text-4xl"></i>
                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-green-500 text-sm">
                            <i class="fas fa-arrow-up"></i> 12.4% from last month
                        </span>
                        <a href="#" class="bg-purple-500 text-white px-3 py-1 rounded hover:bg-purple-600 transition">
                            Show More
                        </a>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                <!-- Product Growth Chart -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold mb-4 dark:text-white">Product Growth</h3>
                    <canvas id="productChart" width="400" height="300"></canvas>
                </div>

                <!-- User Growth Chart -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold mb-4 dark:text-white">User Growth</h3>
                    <canvas id="userChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- JavaScript for Dark Mode and Charts -->
        <script>
            // Dark Mode Toggle
            const themeToggle = document.getElementById('theme-toggle');
            const htmlElement = document.documentElement;

            // Check for saved theme preference or default to light mode
            const savedTheme = localStorage.getItem('color-theme');
            if (savedTheme === 'dark') {
                htmlElement.classList.add('dark');
                themeToggle.checked = true;
            }

            // Theme toggle event listener
            themeToggle.addEventListener('change', () => {
                if (themeToggle.checked) {
                    htmlElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    htmlElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            });

            // Animated Number Counters
            function animateValue(id, start, end, duration) {
                const element = document.getElementById(id);
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    element.textContent = Math.floor(progress * (end - start) + start);
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            }

            // Animate metrics
            animateValue('total-products', 0, {{ $totalProducts }}, 2000);
            animateValue('total-users', 0, {{ $totalUsers }}, 2000);

            // Product Growth Chart
            const productCtx = document.getElementById('productChart').getContext('2d');
            const productChart = new Chart(productCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Product Growth',
                        data: [40, 55, 45, 65, 49, 60],
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
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

            // User Growth Chart
            const userCtx = document.getElementById('userChart').getContext('2d');
            const userChart = new Chart(userCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'User Growth',
                        data: [100, 120, 140, 160, 180, 200],
                        backgroundColor: 'rgb(54, 162, 235)',
                    }]
                },
                options: {
                    responsive: true,
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
        </script>
    </body>

    </html>
@endsection
