<!DOCTYPE html>
<html lang="en">

@include('students/layout/header')

<body>
    <div style="display: flex; align-items: center; justify-content: center;">

        {{-- <img src="{{ asset('login_frontend/images/logo.png') }}" width="45px" id="welcome_img" alt="logo_img"
            style="margin-right: 10px; padding-top: 10px;"> --}}
        <h2 style="color: #000; text-align: center; padding-top: 15px; margin: 0;"><strong>CRUD
                OPERATIONS</strong></h2>

    </div>

    @yield('content')

</body>



</html>
