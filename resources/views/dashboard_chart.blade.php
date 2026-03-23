<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel 13 Charts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">

    <h1 class="text-3xl font-bold mb-8 text-center">Dashboard Statistik</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Area Chart -->
        <div class="bg-white p-6 rounded-lg shadow">
            {!! $areaChart->container() !!}
        </div>

        <!-- Pie Chart -->
        <div class="bg-white p-6 rounded-lg shadow text-center">
            {!! $pieChart->container() !!}
        </div>

        <!-- Bar Chart (Full Width) -->
        <div class="bg-white p-6 rounded-lg shadow md:col-span-2">
            {!! $barChart->container() !!}
        </div>
    </div>

    <!-- Script Utama (Sangat Penting!) -->
    <script src="{{ $areaChart->cdn() }}"></script>
    
    {{ $areaChart->script() }}
    {{ $pieChart->script() }}
    {{ $barChart->script() }}

</body>
</html>
