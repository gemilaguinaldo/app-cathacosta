@extends('partials.base')
@push('styles')
@endpush

@section('content')
  <div class="d-block w-100 mb-20 text-right">
    <h5>
      User Management > Users
    </h5>
  </div>
  <div id="app-user">
    <users></users>
  </div>
@endsection

@push('scripts')
  <script type="text/javascript" src="/js/users.js"></script>
@endpush