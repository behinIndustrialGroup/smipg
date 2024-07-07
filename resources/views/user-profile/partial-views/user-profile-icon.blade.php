
    <a class="" onclick="goto_profile()">
        <i class="fa fa-user"></i>
    </a>

    <script>
        function goto_profile(){
            window.location = "{{ route('user-profile.profile') }}"
        }
    </script>
