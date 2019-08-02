<script>
   window.Laravel = {
        csrfToken: '{{ csrf_token() }}',
        isAuthenticated: "{{ auth()->check() }}",
        userRole: "{{ auth()->check() ? auth()->user()->role->id : null }}",
	    userId: "{{ auth()->check() ? auth()->user()->id : 0 }}",
   };
</script>