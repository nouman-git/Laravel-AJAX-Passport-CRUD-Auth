<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    {{-- <link rel="stylesheet" type="text/css" href="slide navbar style.css"> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet"> --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Jost', sans-serif;
            background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
        }

        .main {
            width: 350px;
            height: 500px;
            background: red;
            overflow: hidden;
            background: url("data:image/jpeg;base64,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") no-repeat center/ cover;
            border-radius: 10px;
            box-shadow: 5px 20px 50px #000;
        }

        #chk {
            display: none;
        }

        .signup {
            position: relative;
            width: 100%;
            height: 100%;
        }

        label {
            color: #fff;
            font-size: 2.3em;
            justify-content: center;
            display: flex;
            margin: 60px;
            font-weight: bold;
            cursor: pointer;
            transition: .5s ease-in-out;
        }

        input {
            width: 60%;
            height: 20px;
            background: #e0dede;
            justify-content: center;
            display: flex;
            margin: 20px auto;
            padding: 10px;
            border: none;
            outline: none;
            border-radius: 5px;
        }

        button {
            width: 60%;
            height: 40px;
            margin: 10px auto;
            justify-content: center;
            display: block;
            color: #fff;
            background: #573b8a;
            font-size: 1em;
            font-weight: bold;
            margin-top: 20px;
            outline: none;
            border: none;
            border-radius: 5px;
            transition: .2s ease-in;
            cursor: pointer;
        }

        button:hover {
            background: #6d44b8;
        }

        .login {
            height: 460px;
            background: #eee;
            border-radius: 60% / 10%;
            transform: translateY(-180px);
            transition: .8s ease-in-out;
        }

        .login label {
            color: #573b8a;
            transform: scale(.6);
        }

        #chk:checked~.login {
            transform: translateY(-500px);
        }

        #chk:checked~.login label {
            transform: scale(1);
        }

        #chk:checked~.signup label {
            transform: scale(.6);
        }
    </style>
</head>

<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">

            <form method="POST" id="login-form">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email" placeholder="Email" required="" id="email">
                <input type="password" name="pswd" placeholder="Password" required="" id="pswd">
                <button type="submit">Login</button>
            </form>

        </div>

        <div class="login">
            <form method="POST" id="registeration-form" autocomplete="new-password">
                <label for="chk" aria-hidden="true">Register</label>
                <input type="text" name="name" placeholder="Name" required="" id="name-reg"
                    autocomplete="new-password">
                <input type="email" name="email" placeholder="Email" required="" id="email-reg"
                    autocomplete="new-password">
                {{-- <input type="password" name="pswd" placeholder="Password" required="" id="pswd-reg"
                    autocomplete="new-password"> --}}
                <input type="password" name="password" placeholder="Password" required="" id="pswd-reg"
                    autocomplete="new-password">


                <button>Register</button>
            </form>
        </div>

    </div>


    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



            //loign
            // alert('sa');
            $('#login-form').on('submit', function(e) {
                // alert('here');
                e.preventDefault(); // Prevent the default form submission

                // Get the form data
                var formData = {
                    email: $('#email').val(),
                    pswd: $('#pswd').val(),
                };

                // alert($('#email').val());
                // alert($('#pswd').val());


                // Send an AJAX POST request to the login route
                $.ajax({
                    type: 'POST',
                    url: 'http://127.0.0.1:8000/login', // Adjust the URL based on your route
                    data: formData,
                    success: function(response) {
                        // Handle success, for example, you can redirect the user to a dashboard
                        alert('Login successful');
                        window.location.href = '/students'; // Redirect URL
                    },
                    error: function(error) {
                        // Handle error, for example, show an error message
                        // alert(error);
                        alert('error in login');

                    }
                });
            });

            // End of Login

            // Registration

            $('#registeration-form').on('submit', function(e) {
                e.preventDefault();

                var formData = {
                    name: $('#name-reg').val(),
                    email: $('#email-reg').val(),
                    password: $('#pswd-reg').val(),
                };
                // alert($('#name-reg').val());
                // alert($('#email-reg').val());
                // alert($('#pswd-reg').val());


                $.ajax({
                    type: 'POST',
                    url: 'http://127.0.0.1:8000/register', // Adjust the URL based on your route
                    data: formData,
                    success: function(response) {
                        alert('Registration successful');
                        let timerInterval
                        Swal.fire({
                            title: 'Registration SuccessfulSu',
                            html: 'You will be logged in automatically in <b></b> milliseconds.',
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                    b.textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log('I was closed by the timer')
                            }
                        }).then(() => {
                            // After the SweetAlert closes, submit the login form
                            $('#login-form')
                                .submit(); // Replace with the actual form ID or selector
                        });
                    },
                    error: function(error) {
                        alert('Error in registration');
                        // Handle the error (e.g., show error messages)
                    }
                });
            });
            //end of registration




        });
    </script>
</body>

</html>
