@extends('layouts.app')

@section('content')

<div class="flex w-full">
    <div class="w-1/3">
        <canvas id="donat"></canvas>
    </div>
    <div class="w-1/2">
        <canvas id="bar"></canvas>
    </div>
</div>

@endsection

@section('script')

<script>
    const ctx = document.getElementById('bar');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: {!! json_encode($salesPerMonth->pluck('month')->map(function($month) { return date('F', mktime(0, 0, 0, $month, 1)); })) !!},
        datasets: [{
          label: '# of Sales',
          data: {!! json_encode($salesPerMonth->pluck('total_sales')) !!},
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    const ctxDonat = document.getElementById('donat');

    new Chart(ctxDonat, {
      type: 'doughnut',
      data: {
        labels: {!! json_encode($salesPerPackage->pluck('nama')) !!},
        datasets: [{
          label: '# of Sales',
          data: {!! json_encode($salesPerPackage->pluck('total_sales')) !!},
        }]
      },
    });
</script>

@endsection
