@extends('partials.base')
@push('styles')
@endpush

@section('content')
  <div class="d-block w-100 mb-20 text-right">
    <h5>
      Expense Management > Expense Categories
    </h5>
  </div>
  <div id="app-category">
    <categories></categories>
  </div>
@endsection

@push('scripts')
  <script type="text/javascript" src="/js/categories.js"></script>
@endpush