<div class="row">
    {{-- {{dd($lokasi_perusahaan)}} --}}
    <div class="col-lg-4 col-xl-4 grid-margin stretch-card">
      <div class="card">
          <div class="card-body">
              <div
                  class="d-flex justify-content-between align-items-baseline mb-2"
              >
                  <h6 class="card-title mb-0">Lokasi Perusahaan</h6>
              </div>
              <div id="lokasiPerusahaanPie"></div>
          </div>
      </div>
    </div>
    <div class="col-lg-8 col-xl-8 grid-margin stretch-card">
      <div class="card">
          <div class="card-body">
              <div
                  class="d-flex justify-content-between align-items-baseline mb-2"
              >
                  <h6 class="card-title mb-0">Jenis Pembiayaan</h6>
              </div>
              <div id="jenisPembiayaanPie"></div>
          </div>
      </div>
    </div>

    <div class="col-lg-4 col-xl-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div
                    class="d-flex justify-content-between align-items-baseline mb-2"
                >
                    <h6 class="card-title mb-0">Lokasi Payor</h6>
                </div>
                <div id="lokasiPayorPie"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-xl-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div
                    class="d-flex justify-content-between align-items-baseline mb-2">
                    <h6 class="card-title mb-0">Jenis Penggunaan</h6>
                </div>
                <div id="jenisPenggunaanChart"></div>
            </div>
        </div>
    </div>
    
    @push('page_specified_js')
        <script>
            document.addEventListener('livewire:load',()=>{

            // Lokasi Perusahaan Pie 
            var lokasiPerusahaanPieChart = new ApexCharts(document.querySelector("#lokasiPerusahaanPie"), {
                chart: {
                height: 200,
                type: "pie"
                },
                labels:@this.lokasiPerusahaan,
                colors: ["#ffcf06", "#22b24c"],
                legend: {
                position: 'top',
                horizontalAlign: 'center'
                },
                stroke: {
                colors: ['rgba(0,0,0,0)']
                },
                dataLabels: {
                enabled: false,
                },
                series: @this.lokasiPerusahaanJml,
            });
            lokasiPerusahaanPieChart.render();  
            // Lokasi Perusahaan Pie end

            // 
            var lokasiPayorPieChart = new ApexCharts(document.querySelector("#lokasiPayorPie"), {
                chart: {
                height: 200,
                type: "pie"
                },
                labels:@this.lokasiPayor,
                colors: ["#ffcf06", "#22b24c"],
                legend: {
                position: 'top',
                horizontalAlign: 'center'
                },
                stroke: {
                colors: ['rgba(0,0,0,0)']
                },
                dataLabels: {
                enabled: false,
                },
                series: @this.lokasiPayorJml,
            });
            lokasiPayorPieChart.render();
            // 

            // 
            var jenisPembiayaanOptions = {
                series:@this.jenisPembiayaan,
                chart: {
                type: 'bar',
                height: 200,
                stacked: true,
                stackType: '100%'
              },
              plotOptions: {
                bar: {
                  horizontal: true,
                },
              },
              stroke: {
                width: 1,
                colors: ['#fff']
              },
              xaxis: {
                categories: ['Jumlah Pembiayaan'],
              },
              tooltip: {
                y: {
                  formatter: function (val) {
                    return val
                  }
                }
              },
              fill: {
                opacity: 1
              
              },
              legend: {
                position: 'top',
                horizontalAlign: 'left',
                offsetX: 40
              }
            };
              var jenisPembiayaanChart = new ApexCharts(document.querySelector("#jenisPembiayaanPie"), jenisPembiayaanOptions);
              jenisPembiayaanChart.render(); 
            // 

            var jenisPenggunaanOptions = {
                series:@this.jenisPenggunaan,
                chart: {
                type: 'bar',
                height: 200,
                stacked: true,
                stackType: '100%'
              },
              plotOptions: {
                bar: {
                  horizontal: true,
                },
              },
              stroke: {
                width: 1,
                colors: ['#fff']
              },
              xaxis: {
                categories: ['Jumlah Penggunaan'],
              },
              tooltip: {
                y: {
                  formatter: function (val) {
                    return val
                  }
                }
              },
              fill: {
                opacity: 1
              
              },
              legend: {
                position: 'top',
                horizontalAlign: 'left',
                offsetX: 40
              }
            };
              var jenisPenggunaanChart = new ApexCharts(document.querySelector("#jenisPenggunaanChart"), jenisPenggunaanOptions);
              jenisPenggunaanChart.render(); 

            // 
            // var jenisPenggunaanPieChart = new ApexCharts(document.querySelector("#jenisPenggunaanPie"), {
            //     chart: {
            //     height: 200,
            //     type: "donut"
            //     },
            //     labels:@this.jenisPenggunaan,
            //     colors: @this.jenisPenggunaanColor,
            //     legend: {
            //     position: 'top',
            //     horizontalAlign: 'center'
            //     },
            //     stroke: {
            //     colors: ['rgba(0,0,0,0)']
            //     },
            //     dataLabels: {
            //     enabled: false,
            //     },
            //     series: @this.jenisPenggunaanJml,
            // });
            // jenisPenggunaanPieChart.render();
            // 

            // 
            // var jenisPenggunaanChartOptions = {
            //     series: [{
            //     data: [400, 430]
            //   }],
            //     chart: {
            //     type: 'bar',
            //     height: 200,
            //   },
            //   colors: ["#ffcf06", "#22b24c"],
            //   plotOptions: {
            //     bar: {
            //       borderRadius: 4,
            //       horizontal: true,
            //     }
            //   },
            //   dataLabels: {
            //     enabled: false
            //   },
            //   xaxis: {
            //     categories: ['Produktif', 'Konsumtif'],
            //   }
            // };

            //   var chart = new ApexCharts(document.querySelector("#chart"), jenisPenggunaanChartOptions);
            //   chart.render();
              // 
          });
        </script>
    @endpush
</div>
