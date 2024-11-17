@extends('layouts/layoutMaster')

@section('title', 'Rank rewards chart')
@section('content')
  <div class="row">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header header-elements">
          <h5 class="card-title mb-0">Rank rewards</h5>
        </div>
        <div class="card-body">
          <canvas id="polarChart" class="chartjs" data-height="337" height="505" width="626" style="display: block; box-sizing: border-box; height: 337px; width: 417px;"></canvas>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('vendor-script')
  @vite([
  'resources/assets/vendor/libs/chartjs/chartjs.js',
  'resources/assets/js/main.js',
  ])

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const polarChart = document.getElementById('polarChart');
      const purpleColor = '#836AF9',
        yellowColor = '#ffe800',
        cyanColor = '#28dac6',
        orangeColor = '#FF8132',
        orangeLightColor = '#FDAC34',
        oceanBlueColor = '#299AFF',
        greyColor = '#4F5D70',
        greyLightColor = '#EDF1F4',
        blueColor = '#2B9AFF',
        blueLightColor = '#84D0FF',
        blueDarkColor = '#1D9FF2';

      let cardColor, headingColor, labelColor, borderColor, legendColor;

      if (isDarkStyle) {
        cardColor = config.colors_dark.cardColor;
        headingColor = config.colors_dark.headingColor;
        labelColor = config.colors_dark.textMuted;
        legendColor = config.colors_dark.bodyColor;
        borderColor = config.colors_dark.borderColor;
      } else {
        cardColor = config.colors.cardColor;
        headingColor = config.colors.headingColor;
        labelColor = config.colors.textMuted;
        legendColor = config.colors.bodyColor;
        borderColor = config.colors.borderColor;
      }
      if (polarChart) {
        const polarChartVar = new Chart(polarChart, {
          type: 'polarArea',
          data: {
            labels: @json($labels),
            datasets: [
              {
                label: 'Total users',
                backgroundColor: [purpleColor, yellowColor, orangeColor, oceanBlueColor, greyColor, cyanColor],
                data: @json($labelvalues),
                borderWidth: 0
              }
            ]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
              duration: 500
            },
            scales: {
              r: {
                ticks: {
                  display: false,
                  color: labelColor
                },
                grid: {
                  display: false
                }
              }
            },
            plugins: {
              tooltip: {
                // Updated default tooltip UI
                rtl: isRtl,
                backgroundColor: cardColor,
                titleColor: headingColor,
                bodyColor: legendColor,
                borderWidth: 1,
                borderColor: borderColor
              },
              legend: {
                rtl: isRtl,
                position: 'right',
                labels: {
                  usePointStyle: true,
                  padding: 25,
                  boxWidth: 8,
                  boxHeight: 8,
                  color: legendColor
                }
              }
            }
          }
        });
      }
    });
  </script>
@stop
