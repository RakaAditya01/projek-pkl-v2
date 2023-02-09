@extends('layouts.app')

@section('title', 'Grafik')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Grafik Peminjam</h1>
        </div>
        <body>
          <canvas id="myChart" height="100px"></canvas>
      </body>
            </div>
        </div>
    </section>
@include('sweetalert::alert')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
<script type="text/javascript">
  
      var labels =  {{ Js::from($labels) }};
      var peminjams =  {{ Js::from($data) }};
  
      const data = {
        labels: labels,
        datasets: [{
          label: 'DATA PEMINJAM',
          backgroundColor: 'rgb(0, 0, 255)',
          borderColor: 'rgb(0, 0, 255)',
          data: peminjams,
        }]
      };
  
      const config = {
        type: 'line',
  data: data,
  options: {
    animations: {
      tension: {
        duration: 1000,
        easing: 'linear',
        from: 1,
        to: 0,
        loop: true
      }
    },
    scales: {
      y: { // defining min and max so hiding the dataset does not change scale range
        min: 0,
        max: 100
      }
    }
  }
};
  
      const myChart = new Chart(
        document.getElementById('myChart'),
        config
      );
  
</script>
@endsection
