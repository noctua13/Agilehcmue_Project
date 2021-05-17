@extends('layoutAdmin.main')
@section('title', 'Coffee/Grand Order | Quản lý đơn hàng')

@section('page-css')
    <script src="https://kit.fontawesome.com/d87577f1bf.js" crossorigin="anonymous"></script>
	<style>
        .action-icon {
            margin-right: 5px;
            font-size: 20px;
            color: black;
        }

        .product-list {
            width: 90%;
            margin: 10px auto;
            border: solid 2px black;
            border-radius: 5px;
        }

        .search-form {
            margin: 50px 205px 0 205px;
        }

        .add-product {
            margin-left: 600px;
            font-size: 25px;
            color: black;
        }

        .page-nav {
            margin: 10px 620px;
        }

        .page-link {
            color: black;
        }
        .table td, .table th {
    padding: .75rem;
    vertical-align: middle;
    text-align : center;
    border-top: 1px solid #dee2e6;
}
    </style>
@endsection

@section('content')  
<div class="container">  
    <h1 class="tm-handwriting-font">Drink</h1>
    <div class="row">
        <div class="col-6">
            <h1 class="tm-handwriting-font">All</h1>
            <canvas id="myChart" width="400" height="150"></canvas>
        </div>
        <div class="col-6">
            <h1 class="tm-handwriting-font">Per day</h1>
            <canvas id="myChartToday" width="400" height="150"></canvas>
        </div> 
        <div class="col-6">
            <h1 class="tm-handwriting-font">Per Month</h1>
            <canvas id="myChartThisMonth" width="400" height="150"></canvas>
        </div>
        <div class="col-6">
            <h1 class="tm-handwriting-font">Per year</h1>
            <canvas id="myChartThisYear" width="400" height="150"></canvas>
        </div>
    </div>
    <h1 class="tm-handwriting-font">Bill</h1>
    <div class="row">
        <div class="col-6">
            <h1 class="tm-handwriting-font">Month Per Year</h1>
            <canvas id="myChartMonthPerYear" width="400" height="150"></canvas>
        </div>
        <div class="col-6">
            <h1 class="tm-handwriting-font">Week Per Month</h1>
            <canvas id="myChartBillWeekPerMonth" width="400" height="150"></canvas>
        </div> 
        <div class="col-6">
            <h1 class="tm-handwriting-font">Day Per Week</h1>
            <canvas id="myChartBillDayPerWeek" width="400" height="150"></canvas>
        </div>
    </div>
    </div>
@endsection
@section('page-js')
<script src="./js/chartjs/dist/chart.js"></script>
    <script>
        //All data
        var ctx = document.getElementById('myChart').getContext('2d');       
        var allData = @json($analize);
        var dataName = new Array(0);
        var dataQuantity = new Array(0);
        for (var arrayIndex in allData) {
          dataName.push(allData[arrayIndex].name);
          dataQuantity.push(allData[arrayIndex].sum);
        }
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dataName,
                datasets: [{
                    label: 'Quantity',
                    data: dataQuantity,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
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

        //Today data
        var ctxToday = document.getElementById('myChartToday').getContext('2d');
        var todayData = @json($analizeToday);
        var dataNameToday = new Array(0);
        var dataQuantityToday = new Array(0);
        for (var arrayIndexToday in todayData) {
          dataNameToday.push(todayData[arrayIndexToday].name);
          dataQuantityToday.push(todayData[arrayIndexToday].sum);
        }     
        var myChartToday = new Chart(ctxToday, {
            type: 'bar',
            data: {
                labels: dataNameToday,
                datasets: [{
                    label: 'Quantity',
                    data: dataQuantityToday,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
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

        //Week data
        var ctxThisMonth = document.getElementById('myChartThisMonth').getContext('2d');
        var WeekData = @json($analizeThisMonth);
        var dataNameThisMonth = new Array(0);
        var dataQuantityThisMonth = new Array(0);
        for (var arrayIndexThisMonth in WeekData) {
          dataNameThisMonth.push(WeekData[arrayIndexThisMonth].name);
          dataQuantityThisMonth.push(WeekData[arrayIndexThisMonth].sum);
        }     
        var myChartThisMonth = new Chart(ctxThisMonth, {
            type: 'bar',
            data: {
                labels: dataNameThisMonth,
                datasets: [{
                    label: 'Quantity',
                    data: dataQuantityThisMonth,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
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

        //This year data
        var ctxThisYear = document.getElementById('myChartThisYear').getContext('2d');
        var thisyearData = @json($analizeThisYear);
        var dataNameThisYear = new Array(0);
        var dataQuantityThisYear = new Array(0);
        for (var arrayIndexThisYear in thisyearData) {
          dataNameThisYear.push(thisyearData[arrayIndexThisYear].name);
          dataQuantityThisYear.push(thisyearData[arrayIndexThisYear].sum);
        }     
        var myChartThisYear = new Chart(ctxThisYear, {
            type: 'bar',
            data: {
                labels: dataNameThisYear,
                datasets: [{
                    label: 'Quantity',
                    data: dataQuantityThisYear,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
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

        //Bill
        //Week per year data
        var ctxBillMonthPerYear = document.getElementById('myChartMonthPerYear').getContext('2d');
        var billMonthPerYearData = @json($billMonthPerYear);
        var dataNameBillMonthPerYear = new Array(0);
        var dataQuantityBillMonthPerYear = new Array(0);
        for (var arrayIndexBillMonthPerYear in billMonthPerYearData) {
          dataNameBillMonthPerYear.push(billMonthPerYearData[arrayIndexBillMonthPerYear].time);
          dataQuantityBillMonthPerYear.push(billMonthPerYearData[arrayIndexBillMonthPerYear].bill);
        }     
        var myChartMonthPerYear = new Chart(ctxBillMonthPerYear, {
            type: 'line',
            data: {
                labels: dataNameBillMonthPerYear,
                datasets: [{
                    label: 'Quantity',
                    data: dataQuantityBillMonthPerYear,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
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
        //This weekWeek data
        var ctxBillWeekPerMonth = document.getElementById('myChartBillWeekPerMonth').getContext('2d');
        var billWeekPerMonthData = @json($billWeekPerMonth);
        var dataNameBillWeekPerMonth = new Array(0);
        var dataQuantityBillWeekPerMonth = new Array(0);
        for (var arrayIndexBillWeekPerMonth in billWeekPerMonthData) {
          dataNameBillWeekPerMonth.push(billWeekPerMonthData[arrayIndexBillWeekPerMonth].week);
          dataQuantityBillWeekPerMonth.push(billWeekPerMonthData[arrayIndexBillWeekPerMonth].bill);
        }     
        var myChartBillWeekPerMonth = new Chart(ctxBillWeekPerMonth, {
            type: 'line',
            data: {
                labels: dataNameBillWeekPerMonth,
                datasets: [{
                    label: 'Quantity',
                    data: dataQuantityBillWeekPerMonth,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
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
        //This day per week data
        var ctxBillDayPerWeek = document.getElementById('myChartBillDayPerWeek').getContext('2d');
        var billDayPerWeekData = @json($billDayPerWeek);
        var dataNameBillDayPerWeek = new Array(0);
        var dataQuantityBillDayPerWeek = new Array(0);
        for (var arrayIndexBillDayPerWeek in billDayPerWeekData) {
          dataNameBillDayPerWeek.push(billDayPerWeekData[arrayIndexBillDayPerWeek].time);
          dataQuantityBillDayPerWeek.push(billDayPerWeekData[arrayIndexBillDayPerWeek].bill);
        }     
        var myChartBillDayPerWeek = new Chart(ctxBillDayPerWeek, {
            type: 'line',
            data: {
                labels: dataNameBillDayPerWeek,
                datasets: [{
                    label: 'Quantity',
                    data: dataQuantityBillDayPerWeek,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
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
    </script>
@endsection
