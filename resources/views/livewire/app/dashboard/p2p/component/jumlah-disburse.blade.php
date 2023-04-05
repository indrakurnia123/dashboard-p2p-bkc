<div class="row">
    <div class="col-12">
        <div class="row flex-grow">
        <div class="col-12 col-lg-12 col-lg-12 grid-margin stretch-card">
            <div class="card card-rounded">
                <div class="card-body">
                    <h6 class="card-title">Performa P2P Lending 12 Bulan (Dalam Miliar)</h6>
                    <div id="jumlahDisburseLine"></div>
                </div>
            </div>
        </div>
        </div>
    </div>
    @push('page_specified_js')
    <script>
        document.addEventListener('livewire:load',()=>{
            // Apex Line chart start

            var optionJumlahDisburseLine = {
                chart: {
                height: 300,
                type: "area",
                parentHeightOffset: 0
                },
                colors: ["#f77eb9", "#7ee5e5"],
                grid: {
                borderColor: "rgba(77, 138, 240, .1)",
                padding: {
                    bottom: -15
                }
                },
                series: [
                {
                    type:'area',
                    data: @this.dataNominalRepayment,
                    name : 'Repayment'
                },{
                    type:'area',
                    data: @this.dataNominalDisburse,
                    name:'Disburse'
                }
                ],
                yaxis:{                    
                    title: {
                    text: "Nominal"
                    }
                },  
                xaxis: {                 
                    title: {
                    text: "Bulan"
                    }
                    // type:'datetime',
                    // labels: {
                    //     formatter: function (value, timestamp) {
                    //        time = new Date(timestamp)
                    //     return  bulan[time.getMonth()]// The formatter function overrides format property
                    //     },
                    // }
                    // labels: {
                    //     format: 'dd MMM'
                    // }
                },
                markers: {
                    size: 0,
                    colors: undefined,
                    strokeColors: '#fff',
                    strokeWidth: 2,
                    strokeOpacity: 0.9,
                    strokeDashArray: 0,
                    fillOpacity: 1,
                    discrete: [],
                    shape: "circle",
                    radius: 2,
                    offsetX: 0,
                    offsetY: 0,
                    onClick: undefined,
                    onDblClick: undefined,
                    showNullDataPoints: true,
                    hover: {
                    size: undefined,
                    sizeOffset: 3
                    }
                },
                stroke: {
                width: 2,
                curve: "straight",
                lineCap: "round"
                },
                legend: {
                show: true,
                position: "top",
                horizontalAlign: 'left',
                containerMargin: {
                    top: 30
                }
                },
                responsive: [
                {
                    breakpoint: 500,
                    options: {
                    legend: {
                        fontSize: "11px"
                    }
                    }
                }
                ]
            };
            var jumlahDisburseChart = new ApexCharts(document.querySelector("#jumlahDisburseLine"), optionJumlahDisburseLine);
            jumlahDisburseChart.render();
            // }
        });
      </script>
    @endpush
</div>
                      <!-- TUTUP ROW LINE CHART -->