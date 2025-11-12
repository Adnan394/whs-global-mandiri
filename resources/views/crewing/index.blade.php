@extends('layout.crewing')

@section('content')
    <main id="main">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        </ol>
        </nav>
        
        <section class="section dashboard">
        <div class="row">
          <!-- Left side columns -->
          <div class="col-lg-8">
            <div class="row">
              
              <div class="">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">CANDIDATE</h5>

                    <!-- Bar Chart -->
                    <canvas id="barChart" style="max-height: 400px;"></canvas>
                    <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            const labels = {!! json_encode($candidateGrouping->keys()) !!};  // nama rank
                            const dataValues = {!! json_encode($candidateGrouping->values()) !!}; // jumlah per rank

                            new Chart(document.querySelector('#barChart'), {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Total Crew per Rank',
                                        data: dataValues,
                                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                        borderColor: 'rgb(54, 162, 235)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            ticks: {
                                                precision: 0 // biar gak ada koma
                                            }
                                        }
                                    }
                                }
                            });
                        });
                        </script>
                    <!-- End Bar CHart -->

                    </div>
                </div>
                </div>
            </div>
          </div>
          <!-- End Left side columns -->

          <!-- Right side columns -->
          <div class="col-lg-4">
            <!-- Revenue Card -->
              <div class="">
                <div class="card info-card revenue-card">
                  <div class="card-body">
                    <h5 class="card-title">ACTIVE CREW</h5>

                    <div class="d-flex align-items-center">
                      <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-person"></i>
                      </div>
                      <div class="ps-3">
                        <h6>{{ $activeCrew }} Active Crew</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Revenue Card -->
            <!-- Website Traffic -->    
            <div class="card">
              <div class="card-body pb-0">
                <h5 class="card-title">SUMMARY</h5>

                <div id="trafficChart" style="min-height: 400px" class="echart"></div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                    const chartData = @json(
                        $summaryGrouping->map(function ($count, $key) {
                            return ['value' => $count, 'name' => $key];
                        })->values()
                    );

                    echarts.init(document.querySelector("#trafficChart")).setOption({
                        tooltip: {
                        trigger: "item",
                        },
                        legend: {
                        top: "5%",
                        left: "center",
                        },
                        series: [
                        {
                            name: "Standby On",
                            type: "pie",
                            radius: ["40%", "70%"],
                            avoidLabelOverlap: false,
                            label: {
                            show: false,
                            position: "center",
                            },
                            emphasis: {
                            label: {
                                show: true,
                                fontSize: "18",
                                fontWeight: "bold",
                            },
                            },
                            labelLine: {
                            show: false,
                            },
                            data: chartData
                        },
                        ],
                    });
                    });
                </script>
              </div>
            </div>
            <!-- End Website Traffic -->
          </div>
          <!-- End Right side columns -->
        </div>
      </section>
    </main>
@endsection