@extends('partials.base')
@push('styles')
@endpush

@section('content')
	<div class="d-block w-100 mb-20 text-right">
	  <h5>
	    User Management > Roles
	  </h5>
	</div>
	<div id="app-role">
		<roles></roles>
	</div>
@endsection

@push('scripts')
	<script type="text/javascript" src="/js/roles.js"></script>
@endpush