@extends('layouts.app')

@section('dashboard-active', 'active')
@section('content')
    <p class="fs-6 fw-bold">Number of members</p>
    <div class="d-flex justify-content-around align-items-center flex-wrap">
        <div style="width:150px;height:150px;" class="bd-white shadow rounded-circle">
            <img src="{{ asset('image/free.png') }}" style="width: 50px;height:50px;margin-top:16px;" class="d-block mx-auto">
            <p class="fw-bold text-center mb-0">Free</p>
            <p class="fw-bold text-center fs-3 text-dark">{{ $free_user }}</p>
        </div>
        <div style="width:150px;height:150px;" class="bd-white shadow rounded-circle">
            <img src="{{ asset('image/platinum.png') }}" style="width: 50px;height:50px;margin-top:16px;"
                class="d-block mx-auto">
            <p class="fw-bold text-center mb-0">Platinum</p>
            <p class="fw-bold text-center fs-3 text-dark">{{ $platinum_user }}</p>
        </div>
        <div style="width:150px;height:150px;" class="bd-white shadow rounded-circle">
            <img src="{{ asset('image/gold.png') }}" style="width: 50px;height:50px;margin-top:16px;"
                class="d-block mx-auto">
            <p class="fw-bold text-center mb-0">Gold</p>
            <p class="fw-bold text-center fs-3 text-dark">{{ $gold_user }}</p>
        </div>
        <div style="width:150px;height:150px;" class="bd-white shadow rounded-circle">
            <img src="{{ asset('image/diamond.png') }}" style="width: 50px;height:50px;margin-top:16px;"
                class="d-block mx-auto">
            <p class="fw-bold text-center mb-0">Diamond</p>
            <p class="fw-bold text-center fs-3 text-dark">{{ $diamond_user }}</p>
        </div>
        <div style="width:150px;height:150px;" class="bd-white shadow rounded-circle">
            <img src="{{ asset('image/ruby.png') }}" style="width: 50px;height:50px;margin-top:16px;"
                class="d-block mx-auto">
            <p class="fw-bold text-center mb-0">Ruby</p>
            <p class="fw-bold text-center fs-3 text-dark">{{ $ruby_user }}</p>
        </div>
        <div style="width:150px;height:150px;" class="bd-white shadow rounded-circle">
            <img src="{{ asset('image/rubyPremium.png') }}" style="width: 50px;height:50px;margin-top:16px;"
                class="d-block mx-auto">
            <p class="fw-bold text-center mb-0">Ruby Premium</p>
            <p class="fw-bold text-center fs-3 text-dark">{{ $rubyp_user }}</p>
        </div>
    </div>
    <div class="my-5">
        <form class="d-flex justify-content-center gap-5">
            <div>
                <p class="fs-6 fw-bold">Members who upgraded from</p>
                <select style="width: 170px;height:40px" class="ms-4 ps-1 rounded from_member" name="from_member"
                    id="fromMember">
                    @foreach ($member_plans as $member_plan)
                        <option value="{{ $member_plan->id }}">{{ $member_plan->member_type }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <p class="fs-6 fw-bold">Members who upgraded to</p>
                <select style="width: 170px;height:40px" class="ms-4 ps-1 rounded to_member" name="to_member"
                    id="toMember">
                    @foreach ($member_plans as $member_plan)
                        <option value="{{ $member_plan->id }}">{{ $member_plan->member_type }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <p class="mb-3"></p>
                <button id="chart1Form" type="button" class="btn btn-primary mt-4">Search</button>
            </div>
        </form>
    </div>

    <div style="max-width: 700px;max-height:400px;" class="mx-auto">
        <canvas id="chart1"></canvas>
    </div>

    <form action="{{ route('member-upgraded-history') }}" method="POST">
        @csrf
        <div class="d-flex mt-5 justify-content-center gap-5">
            <p class="fs-6 fw-bold">Number of members in</p>
            <select style="width: 170px;height:40px" class="ms-4 ps-1 rounded" name="member_type" id="memberType">
                @foreach ($member_plans as $member_plan)
                    <option value="{{ $member_plan->id }}">{{ $member_plan->member_type }}</option>
                @endforeach
            </select>

            <button id="chart2Form" type="button" class="btn btn-primary">Search</button>
        </div>
    </form>


    <div style="max-width: 700px;max-height:400px;" class="mx-auto">
        <canvas id="chart2"></canvas>
    </div>
@endsection

@push('scripts')
    <script>
        var chart1_form = document.getElementById('chart1Form');
        var chart2_form = document.getElementById('chart2Form');

        chart1_form.addEventListener('click', function(e) {

            e.preventDefault();
            if (myChart1 != null) {
                myChart1.destroy();
            }
            var fromMember = document.getElementById('fromMember').value;
            var toMember = document.getElementById('toMember').value;
            axios.post('/member/upgraded-history/', {
                from_member: fromMember,
                to_member: toMember
            }).then(response => {

                var months = response.data.months
                var monthCount = response.data.monthCount
                const data1 = {
                    labels: months,
                    datasets: [{
                        label: 'Member upgraded history',
                        borderColor: 'rgb(255, 99, 132)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderWidth: 1,
                        data: monthCount,
                    }]
                };

                const config1 = {
                    type: 'bar',
                    data: data1,
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                };

                 myChart1 = new Chart(
                    document.getElementById('chart1'),
                    config1
                );

            })
        })

        chart2_form.addEventListener('click', function(e) {

            e.preventDefault();
            if (myChart2 != null || myChart2 == null) {
                myChart2.destroy();
            }
            var member_type = document.getElementById('memberType').value;

            axios.post('/member/upgraded-history/', {
                member_type: member_type
            }).then(response => {

                var months_filter = response.data.months_filter
                var monthCount_filter = response.data.monthCount_filter
                const data2 = {
                    labels: months_filter,
                    datasets: [{
                        label: 'Number of Member',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgb(54, 162, 235)',
                        borderWidth: 1,
                        data: monthCount_filter
                    }]
                };
                const config2 = {
                    type: 'bar',
                    data: data2,
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                };

                 myChart2 = new Chart(
                    document.getElementById('chart2'),
                    config2
                );

            })
        })

        var months_con = JSON.parse('{!! json_encode($months) !!}');
        var monthCount_con = JSON.parse('{!! json_encode($monthCount) !!}');

        var months_filter_con = JSON.parse('{!! json_encode($months_filter) !!}');
        var monthCount_filter_con = JSON.parse('{!! json_encode($monthCount_filter) !!}');


        const data1 = {
            labels: months_con,
            datasets: [{
                label: 'Member upgraded history',
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                data: monthCount_con,
                borderWidth: 1
            }]
        };

        const config1 = {
            type: 'bar',
            data: data1,
            options: {}
        };

        var myChart1 = new Chart(
            document.getElementById('chart1'),
            config1
        );


        const data2 = {
            labels: months_filter_con,
            datasets: [{
                label: 'Number of Member',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgb(54, 162, 235)',
                data: monthCount_filter_con,
                borderWidth: 1,
            }]
        };


        const config2 = {
            type: 'bar',
            data: data2,
            options: {}
        };

        var myChart2 = new Chart(
            document.getElementById('chart2'),
            config2
        );
    </script>
@endpush
