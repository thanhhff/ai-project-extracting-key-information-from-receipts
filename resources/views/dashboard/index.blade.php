@extends('dashboard.layouts.master')
@section('content')
  <div class="row">
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">{{ __('index.dash_amount_in_month') }}</p>
                <h5 class="font-weight-bolder mb-0">
                  {{\App\Helpers\format_currency($totalAmountInMonths)}}<br>
                  @if($amountDiff >= 0)
                    @if($amountDiff != 0)
                    <span class="text-success text-sm font-weight-bolder">+{{$amountDiff}}%</span>
                    @endif
                  @else 
                    <span class="text-danger text-sm font-weight-bolder">-{{abs($amountDiff)}}%</span>
                  @endif
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">{{ __('index.dash_bill_in_month') }}</p>
                <h5 class="font-weight-bolder mb-0">
                  {{$numOfBills}}<br>
                  @if($billDiff >= 0)
                    @if($billDiff != 0)
                    <span class="text-success text-sm font-weight-bolder">+{{$billDiff}}%</span>
                    @endif
                  @else 
                    <span class="text-danger text-sm font-weight-bolder">-{{abs($billDiff)}}%</span>
                  @endif
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="fa fa-receipt text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">{{ __('index.dash_total_bill') }}</p>
                <h5 class="font-weight-bolder mb-0">
                  {{count($totalBills)}}<br>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="fa fa-receipt text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  
  </div>
  <div class="row mt-4">
    <div class="col-lg-5 mb-lg-0 mb-4">
      <div class="card h-100">
        <div class="card-header pb-0">
          <h6>{{ __('index.dash_recent_payments') }}</h6>
        </div>
        <div class="card-body p-3">
            @if(count($recentBills) <= 0)
              <div class="text-center m-4">
                <h6 style="color: red">{{ __('index.no_data') }}</h6>
              </div>
            @else
            <div class="timeline timeline-one-side">
              @foreach($recentBills as $bill)
                <div class="timeline-block mb-3">
                  <span class="timeline-step">
                    @switch($bill->category_id)
                      @case(1)
                        <i class="fa fa-cutlery text-warning text-gradient"></i>
                        @break
                      @case(2)
                        <i class="ni ni-cart text-dark text-gradient"></i>
                        @break
                      @case(3)
                        <i class="fa fa-taxi text-danger text-gradient"></i>
                        @break
                      @case(4)
                        <i class="ni ni-atom text-dark text-gradient"></i>
                        @break
                      @case(5)
                        <i class="fa fa-gamepad text-primary text-gradient"></i>
                        @break
                      @default
                        <i class="ni ni-money-coins text-info text-gradient"></i>
                        @break
                    @endswitch
                  </span>
                  <div class="timeline-content">
                    <a href="{{route('bill.edit', $bill->id)}}" class="text-success text-sm font-weight-bold mb-0">
                      #{{$bill->id}} &nbsp; &nbsp;&nbsp;
                    </a>
                    <span class="text-dark text-sm font-weight-bold mb-0">{{\App\Helpers\format_currency($bill->total)}}</span>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{\App\Helpers\format_date($bill->payment_date)}}</p>
                  </div>
                </div>
              @endforeach
            </div>
            @endif
        </div>
      </div>
    </div>
    <div class="col-lg-7">
      <div class="card mb-3">
        <div class="card-header pb-0">
          <h6>{{ __('index.dash_cost_analysis') }}</h6>
        </div>
        <div class="card-body p-3">
          @if(count($totalBills) <= 0)
            <div class="text-center m-4">
              <h6 style="color: red">{{ __('index.no_data') }}</h6>
            </div>
          @else
          <div class="chart">
            <canvas id="chart-pie" class="chart-canvas" height="150px"></canvas>
          </div>
          @endif
        </div>
      </div>
      <!-- <div class="card">
        <div class="card-header pb-0">
          <h6>{{ __('index.dash_monthly_follow') }}</h6>
        </div>
        <div class="card-body p-3">
          @if(count($totalBills) <= 0)
            <div class="text-center m-4">
              <h6 style="color: red">{{ __('index.no_data') }}</h6>
            </div>
          @else
          <div class="chart">
            <canvas id="chart-line" class="chart-canvas" height="300px"></canvas>
          </div>
          @endif
        </div>
      </div> -->
      
    </div>
  </div>

    <script>

    const groupAmountByCategories = (object) => {
      let data = [];
      for (const key in object) {
        data.push(object[key].reduce((accumulator, i) => {return accumulator + i['total']}, 0))
      }
      return data;
    }

    const categories = {!! json_encode($categories) !!};
    categorieLabels = categories.map(item => item.name)
    const billGrCategory  = {!! json_encode($billGrCategory) !!};
    const data1 = groupAmountByCategories(billGrCategory)
    
    
    var ctx = document.getElementById("chart-pie").getContext("2d");

    if(ctx) {
      new Chart(ctx, {
        type: "pie",
        data: {
          labels: categorieLabels,
          datasets: [{
            label: 'Chi phí',
            data: data1,
            backgroundColor: ['#1e3d58', '#f5f0e1', '#ff6e40', '#ffc13b', '#1e847f', '#1868ae'],
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'bottom',
            },
            title: {
              display: true,
              text: 'Các loại chi phí'
            }
          }
        },
      });
    }

    

    var ctx2 = document.getElementById("chart-line").getContext("2d");

    if(ctx2) {
      var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

      gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
      gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
      gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); 

      var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

      gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
      gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
      gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); 


      new Chart(ctx2, {
        type: "line",
        data: {
          labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
              label: "Số tiền thanh toán",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#cb0c9f",
              borderWidth: 3,
              backgroundColor: gradientStroke1,
              data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
              maxBarThickness: 6

            }
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            display: false,
          },
          tooltips: {
            enabled: true,
            mode: "index",
            intersect: false,
          },
          scales: {
            yAxes: [{
              gridLines: {
                borderDash: [2],
                borderDashOffset: [2],
                color: '#dee2e6',
                zeroLineColor: '#dee2e6',
                zeroLineWidth: 1,
                zeroLineBorderDash: [2],
                drawBorder: false,
              },
              ticks: {
                suggestedMin: 0,
                suggestedMax: 500,
                beginAtZero: true,
                padding: 10,
                fontSize: 11,
                fontColor: '#adb5bd',
                lineHeight: 3,
                fontStyle: 'normal',
                fontFamily: "Open Sans",
              },
            }, ],
            xAxes: [{
              gridLines: {
                zeroLineColor: 'rgba(0,0,0,0)',
                display: false,
              },
              ticks: {
                padding: 10,
                fontSize: 11,
                fontColor: '#adb5bd',
                lineHeight: 3,
                fontStyle: 'normal',
                fontFamily: "Open Sans",
              },
            }, ],
          },
        },
      });
    }
    
  </script>
@endsection