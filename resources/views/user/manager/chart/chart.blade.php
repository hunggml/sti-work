@extends('user.master.master')
@section('title', 'Biểu đồ thống kê')
@section('content')
    {{-- chart --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.2/chart.min.js"
        integrity="sha512-dnUg2JxjlVoXHVdSMWDYm2Y5xcIrJg1N+juOuRi0yLVkku/g26rwHwysJDAMwahaDfRpr1AxFz43ktuMPr/l1A=="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="card">
        <div>
            <canvas id="myChart"></canvas>
        </div>
    </div>
   
@push('script')
<script>
    $.ajax({
        url: window.location.origin + '/api/chart-api/',
        type: 'GET',
        error: function(jqXHR, textStatus, errorThrown) {
            
        },
        success: function(users) {
            users = users;
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                data: {
                    datasets: [{
                    type: 'bar',
                    label: 'Quá hạn',
                    data:  outTime(users),
                    backgroundColor : [
                        'red',
                    ]
                }, {
                    type: 'bar',
                    label: 'Đúng hạn',
                    data: onTime(users),
                    backgroundColor : [
                        'greenyellow',
                    ]
                },{
                    type: 'bar',
                    label: 'Chưa đến hạn',
                    data: inTime(users),
                    backgroundColor : [
                        '#6a6f8c',
                    ]
                }],
            
                labels: callback(users)
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
            });
        }
    });
   
    function outTime(users){
        let outTime = [];
        users.map((user, index) => {
            outTime[index] = (user.work.filter(work => work.progress == 2)).length;
        })
        return outTime;
    }
    function inTime(users){
        let inTime = [];
        users.map((user, index) => {
            inTime[index] = (user.work.filter(work => work.progress == 0)).length;
        })
        return inTime;
    }
    function onTime(users){
        let onTime = [];
        users.map((user, index) => {
            onTime[index] = (user.work.filter(work => work.progress == 1)).length;
        })
        return onTime;
    }

    function callback(users){
        let labels = [];
        users.forEach(function(user){
            labels.push(user.name)
        });
        
        return labels;
        // console.log(on_time, out_time);
        
    }
    

</script>
@endpush
    
@endsection
