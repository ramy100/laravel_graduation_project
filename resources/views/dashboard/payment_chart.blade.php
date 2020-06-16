@extends('layouts.admin')

@section('content')
    <div class="container">
        <div id="chart" style="height: 300px;"></div>

    </div>
@endsection
@push('scripts')
    <!-- Charting library -->
    <script src="https://unpkg.com/chart.js/dist/Chart.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/chartjs/dist/chartisan_chartjs.js"></script>
    <script>
        const chart = new Chartisan({
          el: '#chart',
          url: 'http://localhost:8000/admin/charts/paymentdata',
          hooks: new ChartisanHooks()
            .colors(['#ECC94B', '#4299E1'])
            .responsive()
            .beginAtZero()
            .legend({ position: 'bottom' })
            .title('This is a sample chart using chartisan!')
            .datasets([{ type: 'line', fill: false }, 'bar']),
        })
      </script>
@endpush
