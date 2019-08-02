@extends('partials.base')
@push('styles')
@endpush

@section('content')
<div id="app-profile">
	<information></information>
	<security class="mt-20"></security>
</div>
@endsection

@push('scripts')
	<script type="text/javascript" src="/js/profile.js"></script>
@endpush