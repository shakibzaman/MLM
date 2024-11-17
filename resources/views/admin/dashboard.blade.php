@extends('layouts/layoutMaster')
@section('title', 'Dashboard')
@section('vendor-style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.6.0/css/flag-icon.min.css">
<style>
    .dashboard-top-card {
        background: rgb(8, 13, 111);
        background: linear-gradient(180deg, rgba(8, 13, 111, 1) 34%, rgba(121, 26, 9, 1) 100%, rgba(0, 212, 255, 1) 100%);
    }
</style>

@endsection

@section('vendor-script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
    loadChartData(); // Load current month's data by default

    document.getElementById('dateRangeForm').addEventListener('submit', function(e) {
        e.preventDefault();
        loadChartData();
    });

    // Adjust chart size on window resize for better responsiveness
    window.addEventListener('resize', function() {
        if (window.depositWithdrawChart) {
            window.depositWithdrawChart.resize();
        }
    });
});

function loadChartData() {
    const startDate = document.getElementById('start_date').value;
    const endDate = document.getElementById('end_date').value;

    const url = startDate && endDate
        ? `/chart-data?start_date=${startDate}&end_date=${endDate}`
        : `/chart-data`; // Default: load current month data if no dates provided

    fetch(url)
        .then(response => response.json())
        .then(data => {
            const labels = data.labels;
            const totalDepositData = data.total_deposit;
            const totalWithdrawData = data.total_withdraw;

            // Destroy previous instance of the chart to avoid memory leaks
            if (window.depositWithdrawChart instanceof Chart) {
                window.depositWithdrawChart.destroy();
            }

            const ctx = document.getElementById('depositWithdrawChart').getContext('2d');
            window.depositWithdrawChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: `Total Deposit $${totalDepositData.reduce((a, b) => a + b, 0)}`,
                            data: totalDepositData,
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: `Total Withdraw $${totalWithdrawData.reduce((a, b) => a + b, 0)}`,
                            data: totalWithdrawData,
                            backgroundColor: 'rgba(60, 179, 113, 0.5)',
                            borderColor: 'rgba(60, 179, 113, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Allows the chart to fill the parent container
                    scales: {
                        x: {
                            title: { display: true, text: 'Date' },
                            grid: { display: false }
                        },
                        y: {
                            beginAtZero: true,
                            title: { display: true, text: 'Amount' },
                            ticks: {
                                stepSize: 100,
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: { size: 14 }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label}: $${context.raw.toFixed(2)}`;
                                }
                            }
                        }
                    }
                }
            });
        });
}

// Package Chart Data
var membershipData = @json($memberships);

// Prepare data for the chart
var chartData = Object.keys(membershipData).map(function(key) {
    return { value: membershipData[key], name: key };
});

var monthly_online_pie_basic_element = document.getElementById('monthly_online_pie_basic');

if (monthly_online_pie_basic_element) {
    var monthly_online_pie_basic = echarts.init(monthly_online_pie_basic_element);

    // Define a function to resize the chart on window resize
    var resizePackageChart = function() {
        monthly_online_pie_basic.resize();
    };

    // Set initial chart options
    monthly_online_pie_basic.setOption({
        color: ['#5ab1ef', '#2ec7c9', '#d87a80', '#b6a2de'],
        textStyle: {
            fontFamily: 'Roboto, Arial, Verdana, sans-serif',
            fontSize: 13
        },
        title: {
            text: 'Scheme Statistics',
            left: 'center',
            top: '2%',
            textStyle: {
                fontSize: 15,
                fontWeight: 600
            }
        },
        tooltip: {
            trigger: 'item',
            backgroundColor: 'rgba(0,0,0,0.85)', // Black background
            padding: [10, 15],
            textStyle: {
                color: '#ffffff', // White text color
                fontSize: 13,
                fontFamily: 'Roboto, sans-serif'
            },
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },
        legend: {
            orient: 'horizontal',
            bottom: '5%',
            left: 'center',
            data: chartData.map(item => item.name), // Set legend data source
            itemHeight: 8,
            itemWidth: 20,
        },
        series: [{
            name: 'Package Type',
            type: 'pie',
            radius: ['40%', '70%'],
            center: ['50%', '50%'],
            avoidLabelOverlap: false,
            itemStyle: {
                borderColor: '#fff',
                borderWidth: 2
            },
            label: {
                show: false,
                position: 'center'
            },
            emphasis: {
                label: {
                    show: true,
                    fontSize: '15',
                    fontWeight: 'bold'
                }
            },
            labelLine: {
                show: false
            },
            data: chartData
        }]
    });

    // Resize chart on window resize
    window.addEventListener('resize', resizePackageChart);
}



// Browser Chart Data
var browserChartData = @json($browsers);

// Prepare data for the chart
var browserChartDataFormatted = Object.keys(browserChartData).map(function(key) {
    return { value: browserChartData[key], name: key };
});

// Select the element where the chart will be rendered
var browserChartData_element = document.getElementById('browserChartData_pie_basic');

if (browserChartData_element) {
    var monthly_online_pie_basic = echarts.init(browserChartData_element);

    // Define a function to resize the chart on window resize
    var resizeBrowserChart = function() {
        monthly_online_pie_basic.resize();
    };

    // Set initial chart options
    monthly_online_pie_basic.setOption({
        color: ['#5ab1ef', '#2ec7c9', '#d87a80', '#b6a2de'],
        textStyle: {
            fontFamily: 'Roboto, Arial, Verdana, sans-serif',
            fontSize: 13
        },
        title: {
            text: 'Browser Usage Statistics',
            left: 'center',
            top: '2%',
            textStyle: {
                fontSize: 15,
                fontWeight: 600
            }
        },
        tooltip: {
            trigger: 'item',
            backgroundColor: 'rgba(0,0,0,0.85)',
            padding: [10, 15],
            textStyle: {
                color: '#ffffff',
                fontSize: 13,
                fontFamily: 'Roboto, sans-serif'
            },
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },
        legend: {
            orient: 'horizontal',
            bottom: '5%',
            left: 'center',
            data: browserChartDataFormatted.map(item => item.name), // Set legend data source
            itemHeight: 8,
            itemWidth: 20,
        },
        series: [{
            name: 'Browser Type',
            type: 'pie',
            radius: ['40%', '70%'],
            center: ['50%', '50%'],
            avoidLabelOverlap: false,
            itemStyle: {
                borderColor: '#fff',
                borderWidth: 2
            },
            label: {
                show: false,
                position: 'center'
            },
            emphasis: {
                label: {
                    show: true,
                    fontSize: '15',
                    fontWeight: 'bold'
                }
            },
            labelLine: {
                show: false
            },
            data: browserChartDataFormatted
        }]
    });

    // Resize chart on window resize
    window.addEventListener('resize', resizeBrowserChart);
}

// OS Chart Data
var osChartData = @json($oss);

// Prepare data for the chart
var osChartDataFormatted = Object.keys(osChartData).map(function(key) {
    return { value: osChartData[key], name: key };
});

// Select the element where the chart will be rendered
var osChartData_element = document.getElementById('osChartData_pie_basic');

if (osChartData_element) {
    var osChartData_pie_basic = echarts.init(osChartData_element);

    // Define a function to resize the chart on window resize
    var resizeOSChart = function() {
        osChartData_pie_basic.resize();
    };

    // Set initial chart options
    osChartData_pie_basic.setOption({
        color: ['#5ab1ef', '#2ec7c9', '#d87a80', '#b6a2de'],
        textStyle: {
            fontFamily: 'Roboto, Arial, Verdana, sans-serif',
            fontSize: 13
        },
        title: {
            text: 'OS Usage Statistics',
            left: 'center',
            top: '2%',
            textStyle: {
                fontSize: 15,
                fontWeight: 600
            }
        },
        tooltip: {
            trigger: 'item',
            backgroundColor: 'rgba(0,0,0,0.85)',
            padding: [10, 15],
            textStyle: {
                color: '#ffffff',
                fontSize: 13,
                fontFamily: 'Roboto, sans-serif'
            },
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },
        legend: {
            orient: 'horizontal',
            bottom: '5%',
            left: 'center',
            data: Object.keys(osChartData),
            itemHeight: 8,
            itemWidth: 20,
        },
        series: [{
            name: 'OS Type',
            type: 'pie',
            radius: ['40%', '70%'],
            center: ['50%', '50%'],
            avoidLabelOverlap: false,
            itemStyle: {
                borderColor: '#fff',
                borderWidth: 2
            },
            label: {
                show: false,
                position: 'center'
            },
            emphasis: {
                label: {
                    show: true,
                    fontSize: '15',
                    fontWeight: 'bold'
                }
            },
            labelLine: {
                show: false
            },
            data: osChartDataFormatted
        }]
    });

    // Resize chart on window resize
    window.addEventListener('resize', resizeOSChart);
}


// Country Chart Data
var countryChartData = @json($countryData);

// Prepare data for the chart
var countryChartDataFormatted = countryChartData.map(function(item) {
    return { value: item.customer_count, name: item.country_name };
});

// Select the element where the chart will be rendered
var countryChartData_element = document.getElementById('countryChartData_pie_basic');

if (countryChartData_element) {
    var countryChartData_pie_basic = echarts.init(countryChartData_element);
    var resizeChart = function() {
        countryChartData_pie_basic.resize();
    };

    // Set initial chart options
    countryChartData_pie_basic.setOption({
        color: ['#5ab1ef', '#2ec7c9', '#d87a80', '#b6a2de'],
        textStyle: {
            fontFamily: 'Roboto, Arial, Verdana, sans-serif',
            fontSize: 13
        },
        title: {
            text: 'Country Usage Statistics',
            left: 'center',
            top: '2%',
            textStyle: {
                fontSize: 15,
                fontWeight: 600
            }
        },
        tooltip: {
            trigger: 'item',
            backgroundColor: 'rgba(0,0,0,0.85)',
            padding: [10, 15],
            textStyle: {
                color: '#ffffff',
                fontSize: 13,
                fontFamily: 'Roboto, sans-serif'
            },
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },
        legend: {
            orient: 'horizontal',
            bottom: '5%',
            left: 'center',
            data: countryChartDataFormatted.map(item => item.name),
            itemHeight: 8,
            itemWidth: 20,
        },
        series: [{
            name: 'Country',
            type: 'pie',
            radius: ['40%', '70%'],
            center: ['50%', '50%'],
            avoidLabelOverlap: false,
            itemStyle: {
                borderColor: '#fff',
                borderWidth: 2
            },
            label: {
                show: false,
                position: 'center'
            },
            emphasis: {
                label: {
                    show: true,
                    fontSize: '15',
                    fontWeight: 'bold'
                }
            },
            labelLine: {
                show: false
            },
            data: countryChartDataFormatted
        }]
    });

    // Resize chart on window resize
    window.addEventListener('resize', resizeChart);
}



</script>


@endsection
@section('content')
<div class="row-background">
    <div class="card bg-info">
        <div class="row">
            <div class="col-sm-4">
                <div class="card-body">
                    <h2 class="card-text"><span class="text-danger"><i class="fas fa-chart-line"></span></i>
                        Admin Dashboard</h2>
                </div>

            </div>
            <div class="col-sm-8">
                <div class="card-body float-right">
                    <i class="flag-icon flag-icon-us"></i>
                    <h2 class="card-text text-right">Welcome : {{ $user->name }} ( {{ $user->email }}) </h2>
                </div>

            </div>
        </div>
    </div>
    <div class="card dashboard-top-card mb-2 mt-2">
        <div class="row">
            <div class="col-sm-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="card-text text-white"><i class="fas fa-angle-double-right"></i> Important </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3 d-flex align-items-center">
                <div class="card-body">
                    <a href="{{ route('deposits.deposit.type',['type'=>'pending']) }}">
                        <p class="card-text text-white text-right"><i class="fas fa-circle"></i> Pending Deposit
                            ({{
                            $pendingDepositCount }})</p>
                    </a>
                </div>
            </div>
            <div class="col-sm-3 d-flex align-items-center">
                <div class="card-body">
                    <a href="{{ route('pending.withdraw.requests') }}">
                        <p class="card-text text-white text-right"><i class="fas fa-circle"></i> Withdraw Request ({{
                            $pendingWithdrawCount }})</p>
                    </a>
                </div>
            </div>
            <div class="col-sm-3 d-flex align-items-center">
                <div class="card-body">
                    <a href="{{ route('support_tickets.support_ticket.open') }}">
                        <p class="card-text text-white text-right"><i class="fas fa-circle"></i> Support Ticket ({{
                            $openSupportTicketCount }})</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body bg-info text-white p-4 rounded shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-md-3 d-flex justify-content-center">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <div class="col-md-9 text-center text-md-start">
                            <h1 class="card-text mb-1 font-weight-bold text-white">{{ $allCustomerCount }}</h1>
                            <h5 class="mb-0 text-white">Registered User</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body bg-success text-white p-4 rounded shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-md-3 d-flex justify-content-center">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <div class="col-md-9 text-center text-md-start">
                            <h1 class="card-text mb-1 font-weight-bold text-white">{{ $activeCustomerCount }}</h1>
                            <h5 class="mb-0 text-white">Active User</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body bg-primary text-white p-4 rounded shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-md-3 d-flex justify-content-center">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <div class="col-md-9 text-center text-md-start">
                            <h1 class="card-text mb-1 font-weight-bold text-white">{{ $activeCustomerCount }}</h1>
                            <h5 class="mb-0 text-white">Monthly Active User</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body bg-danger text-white p-4 rounded shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-md-3 d-flex justify-content-center">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <div class="col-md-9 text-center text-md-start">
                            <h1 class="card-text mb-1 font-weight-bold text-white">{{ $freeCustomerCount }}</h1>
                            <h5 class="mb-0 text-white">Free User</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-2">

        <div class="col-sm-3">
            <div class="card">
                <div class="card-body bg-warning text-white p-4 rounded shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-md-3 d-flex justify-content-center">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <div class="col-md-9 text-center text-md-start">
                            <h1 class="card-text mb-1 font-weight-bold text-white">{{ $totalDepositAmount }}</h1>
                            <h5 class="mb-0 text-white">Total Deposit</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card">
                <div class="card-body bg-info text-white p-4 rounded shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-md-3 d-flex justify-content-center">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <div class="col-md-9 text-center text-md-start">
                            <h1 class="card-text mb-1 font-weight-bold text-white">{{ $totalWithdrawAmount }}</h1>
                            <h5 class="mb-0 text-white">Total Withdraw</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body bg-secondary text-white p-4 rounded shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-md-3 d-flex justify-content-center">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <div class="col-md-9 text-center text-md-start">
                            <h1 class="card-text mb-1 font-weight-bold text-white">{{ $totalPendingDepositAmount }}</h1>
                            <h5 class="mb-0 text-white">Pending Deposit</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body bg-secondary text-white p-4 rounded shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-md-3 d-flex justify-content-center">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <div class="col-md-9 text-center text-md-start">
                            <h1 class="card-text mb-1 font-weight-bold text-white">{{ $totalPendingWithdrawAmount }}
                            </h1>
                            <h5 class="mb-0 text-white">Pending Withdraw</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-3">
            <div class="card">
                <div class="card-body bg-success text-white p-4 rounded shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-md-3 d-flex justify-content-center">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <div class="col-md-9 text-center text-md-start">
                            <h1 class="card-text mb-1 font-weight-bold text-white">{{ $totalDirectUser }}
                            </h1>
                            <h5 class="mb-0 text-white">Total Direct</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card">
                <div class="card-body bg-primary text-white p-4 rounded shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-md-3 d-flex justify-content-center">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <div class="col-md-9 text-center text-md-start">
                            <h1 class="card-text mb-1 font-weight-bold text-white">{{ $totalReferralUser }}
                            </h1>
                            <h5 class="mb-0 text-white">Total Referral</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card">
                <div class="card-body bg-info text-white p-4 rounded shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-md-3 d-flex justify-content-center">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <div class="col-md-9 text-center text-md-start">
                            <h1 class="card-text mb-1 font-weight-bold text-white">{{ $customerCount6MonthActive }}
                            </h1>
                            <h5 class="mb-0 text-white">6 Monthly Active</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card">
                <div class="card-body bg-warning text-white p-4 rounded shadow-sm">
                    <div class="row align-items-center">
                        <div class="col-md-3 d-flex justify-content-center">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <div class="col-md-9 text-center text-md-start">
                            <h1 class="card-text mb-1 font-weight-bold text-white">{{ $customerCount1YearActive }}
                            </h1>
                            <h5 class="mb-0 text-white">1 Year Active</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mt-4 p-2">
            <div class="card-header border-bottom">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <h4>Site Statistics</h4>
                    </div>
                    <div class="col-md-9">
                        <div class="card-body p-2 border">
                            <form id="dateRangeForm" class="d-flex flex-wrap align-items-center gap-2">
                                <label for="start_date" class="mb-0">Start Date:</label>
                                <input type="date" class="form-control flex-grow-1" id="start_date" name="start_date"
                                    required>

                                <label for="end_date" class="mb-0">End Date:</label>
                                <input type="date" class="form-control flex-grow-1" id="end_date" name="end_date"
                                    required>

                                <button class="btn btn-primary" type="submit">Generate Chart</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="depositWithdrawChart" style="width: 100%; height: 400px; max-height: 500px;"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-4 p-2 mt-2">
        <div class="card">
            <div class="card-title border-bottom mt-2">
                <h4 class="text-center">Scheme Statistics</h4>
            </div>
            <div class="card-body">
                <div id="monthly_online_pie_basic" class="chart has-fixed-height col-md-12"
                    style="width: 100%; height: 400px; max-width: 500px; margin: 0 auto;">
                </div>
            </div>
        </div>
    </div>



    <div class="col-md-4 p-2 mt-2">
        <div class="card">
            <div class="card-title border-bottom mt-2">
                <h4 class="text-center">Country Usage Statistics</h4>
            </div>
            <div class="card-body">
                <div id="countryChartData_pie_basic" class="chart has-fixed-height col-md-12"
                    style="width: 100%; height: 400px; max-width: 500px; margin: 0 auto;">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 p-2 mt-2">
        <div class="card">
            <div class="card-title border-bottom mt-2">
                <h4 class="text-center">Browser Usage Statistics</h4>
            </div>
            <div class="card-body">
                <div id="browserChartData_pie_basic" class="chart has-fixed-height col-md-12"
                    style="width: 100%; height: 400px; max-width: 500px; margin: 0 auto;">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 p-2 mt-2">
        <div class="card">
            <div class="card-title border-bottom mt-2">
                <h4 class="text-center">OS Usage Statistics</h4>
            </div>
            <div class="card-body">
                <div id="osChartData_pie_basic" class="chart has-fixed-height col-md-12"
                    style="width: 100%; height: 400px; max-width: 500px; margin: 0 auto;">
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }} " type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.6.0/css/flag-icon.min.css">
    <style>
    </style>


    @stop