@extends('partials.base')
@push('styles')
@endpush

@section('content')
<div id="app-dashboard">
	<charts></charts>
</div>
@endsection

@push('scripts')
	<script type="text/javascript" src="/js/dashboard.js"></script>
@endpush