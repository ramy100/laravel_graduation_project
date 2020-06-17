@extends('layouts.admin')

@section('content')
    {!! $chart->container() !!}
@endsection
@push('scripts')
    {{-- <script>
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
      </script> --}}
      {!! $chart->script() !!}
@endpush
