@extends('customer.layouts.app')

@section('content')
<h1>Welcome Ruby User -  {{Auth()->user()->name}}</h1>
@endsection
@push('scripts')
@endpush

