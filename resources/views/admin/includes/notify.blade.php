@if(session()->has('success'))
    <script>
        notyf.success("{{ session()->get('success') }}")
    </script>
@endif

@if(session()->has('error'))
    <script>
        notyf.error("{{ session()->get('error') }}")
    </script>
@endif