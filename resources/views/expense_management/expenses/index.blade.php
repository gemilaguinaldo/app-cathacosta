@extends('partials.base')
@push('styles')
@endpush

@section('content')
  <div class="d-block w-100 mb-20 text-right">
    <h5>
      Expense Management > Expenses
    </h5>
  </div>
  <div id="app-expense">
    <expenses></expenses>
  </div>
@endsection

@push('scripts')
  <script type="text/javascript" src="/js/expenses.js"></script>
@endpush