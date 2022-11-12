@extends('layouts.app')

@section('dashboard-active', 'active')
@section('content')
    <p class="fs-6 fw-bold">Number of members</p>
    <div class="d-flex justify-content-around align-items-center flex-wrap">
        <div style="width:150px;height:150px;" class="bd-white shadow rounded-circle">
            <img src="{{ asset('image/free.png') }}" style="width: 50px;height:50px;margin-top:16px;" class="d-block mx-auto">
            <p class="fw-bold text-center mb-0">Free</p>
            <p class="fw-bold text-center fs-3 text-dark">{{$free_user}}</p>
        </div>
        <div style="width:150px;height:150px;" class="bd-white shadow rounded-circle">
            <img src="{{ asset('image/platinum.png') }}" style="width: 50px;height:50px;margin-top:16px;"
                class="d-block mx-auto">
            <p class="fw-bold text-center mb-0">Platinum</p>
            <p class="fw-bold text-center fs-3 text-dark">{{$platinum_user}}</p>
        </div>
        <div style="width:150px;height:150px;" class="bd-white shadow rounded-circle">
            <img src="{{ asset('image/gold.png') }}" style="width: 50px;height:50px;margin-top:16px;"
                class="d-block mx-auto">
            <p class="fw-bold text-center mb-0">Gold</p>
            <p class="fw-bold text-center fs-3 text-dark">{{$gold_user}}</p>
        </div>
        <div style="width:150px;height:150px;" class="bd-white shadow rounded-circle">
            <img src="{{ asset('image/diamond.png') }}" style="width: 50px;height:50px;margin-top:16px;"
                class="d-block mx-auto">
            <p class="fw-bold text-center mb-0">Diamond</p>
            <p class="fw-bold text-center fs-3 text-dark">{{$diamond_user}}</p>
        </div>
        <div style="width:150px;height:150px;" class="bd-white shadow rounded-circle">
            <img src="{{ asset('image/ruby.png') }}" style="width: 50px;height:50px;margin-top:16px;"
                class="d-block mx-auto">
            <p class="fw-bold text-center mb-0">Ruby</p>
            <p class="fw-bold text-center fs-3 text-dark">{{$ruby_user}}</p>
        </div>
        <div style="width:150px;height:150px;" class="bd-white shadow rounded-circle">
            <img src="{{ asset('image/rubyPremium.png') }}" style="width: 50px;height:50px;margin-top:16px;"
                class="d-block mx-auto">
            <p class="fw-bold text-center mb-0">Ruby Premium</p>
            <p class="fw-bold text-center fs-3 text-dark">{{$rubyp_user}}</p>
        </div>
    </div>
    <div class="my-5">
        <form action="{{ route('member-upgraded-history') }}" class="d-flex justify-content-center gap-5" method="POST">
            @csrf
            <div>
                <p class="fs-6 fw-bold">Members who upgraded from</p>
                <select style="width: 170px;height:40px" class="ms-4 ps-1 rounded from_member" name="from_member">
                    @foreach ($member_plans as $member_plan)
                        <option value="{{ $member_plan->id }}">{{ $member_plan->member_type }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <p class="fs-6 fw-bold">Members who upgraded to</p>
                <select style="width: 170px;height:40px" class="ms-4 ps-1 rounded to_member" name="to_member">
                    @foreach ($member_plans as $member_plan)
                        <option value="{{ $member_plan->id }}">{{ $member_plan->member_type }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <p class="mb-3"></p>
                <button type="submit" class="btn btn-primary mt-4">Search</button>
            </div>
        </form>





    </div>

    <div style="max-width: 700px;max-height:400px;" class="mx-auto">
        <canvas id="chart1"></canvas>
        @yield('charts')
    </div>

    <div class="d-flex mt-5 justify-content-center gap-5">
        <p class="fs-6 fw-bold">Number of members in</p>
        <select style="width: 170px;height:40px" class="ms-4 ps-1 rounded">
            <option selected value="january">January</option>
        </select>
        <select style="width: 170px;height:40px" class="ms-4 ps-1 rounded">
            <option selected value="2022">2022</option>
        </select>
        <button class="btn btn-primary">Search</button>
    </div>

    <div style="max-width: 700px;max-height:400px;" class="mx-auto">
        <canvas id="chart2"></canvas>
    </div>
@endsection

@push('scripts')
    <script>
        var months = JSON.parse('{!! json_encode($months) !!}');
        var monthCount = JSON.parse('{!! json_encode($monthCount) !!}');
        const labels1 = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
        ];

        const data1 = {
            labels: months,
            datasets: [{
                label: 'Member upgraded history',
                backgroundColor: '#222E3C',
                borderColor: '#222E3C',
                data: monthCount,
            }]
        };

        const config1 = {
            type: 'bar',
            data: data1,
            options: {}
        };

        const myChart1 = new Chart(
            document.getElementById('chart1'),
            config1
        );

        const labels2 = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
        ];


        const data2 = {
            labels: labels2,
            datasets: [{
                label: 'My First dataset',
                backgroundColor: '#222E3C',
                borderColor: '#222E3C',
                data: [0, 10, 5, 2, 20, 30, 45],
            }]
        };


        const config2 = {
            type: 'bar',
            data: data2,
            options: {}
        };

        const myChart2 = new Chart(
            document.getElementById('chart2'),
            config2
        );
    </script>
@endpush
