<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Players Qr Reg | Dashboard</title>
    <link rel="stylesheet" href="{{ asset('/dashboard/css/admin.css') }}?v={{time()}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="{{ asset('/dashboard/images/adaptive-icon.png') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Noto+Kufi+Arabic:wght@100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: "Noto Kufi Arabic", sans-serif;
        }
    </style>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Russo+One&display=swap");

        svg {
            font-family: "Russo One", sans-serif;
            width: 100%; height: 100%;
        }
        svg text {
            animation: stroke 6s infinite alternate;
            stroke-width: 1px;
            stroke: #365FA0;
            font-size: 50px;
        }
        @keyframes stroke {
            0%   {
                fill: rgba(72,138,204,0); stroke: rgba(54,95,160,1);
                stroke-dashoffset: 25%; stroke-dasharray: 0 50%; stroke-width: 2;
            }
            70%  {fill: rgba(72,138,204,0); stroke: rgba(54,95,160,1); }
            80%  {fill: rgba(72,138,204,0); stroke: rgba(54,95,160,1); stroke-width: 3; }
            100% {
                fill: rgba(72,138,204,1); stroke: rgba(54,95,160,0);
                stroke-dashoffset: -25%; stroke-dasharray: 50% 0; stroke-width: 0;
            }
        }

        .wrapper {
            background-color: #00000031;
            backdrop-filter: blur(2px);
            width: 100%;
            height: 100%;
        }

        .loader {
            width: 100vw;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999;
            display: none
        }

        #errors {
            position: fixed;
            top: 1.25rem;
            right: 1.25rem;
            display: flex;
            flex-direction: column;
            max-width: calc(100% - 1.25rem * 2);
            gap: 1rem;
            z-index: 99999999999999999999;
            overflow: hidden;
        }

        #errors >* {
            max-width: 100%;
            color: #fff;
            font-size: 1.1rem;
            padding: 1rem;
            border-radius: 1rem;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }

        #errors .error {
            background: #e41749;
        }
        #errors .success {
            background: #12c99b;
        }

    </style>
    </head>

    <body>
    <!--  Body Wrapper -->
    <div id="errors"></div>
    <div class="loader">
        <div class="wrapper">
            <svg>
                <text x="50%" y="50%" dy=".35em" text-anchor="middle">
                    Login ...
                </text>
            </svg>
        </div>
    </div>
    <div id="login">
        <form @submit.prevent>
            <h1>سجل الدخول</h1>
            <input type="text" class="form-control" id="username" aria-describedby="emailHelp" v-model="email" placeholder="Email">
            <input type="password" class="form-control" id="password" v-model="password" placeholder="Password">
            <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" @click="login(this.email, this.password)">Log in</button>
        </form>
    </div>
    <script src="{{ asset('/libs/vue.js') }}"></script>
    <script src="{{ asset('/libs/jquery.js') }}"></script>
    <script src="{{ asset('/libs/axios.js') }}"></script>
    <script src="{{ asset('/dashboard/js/login.js') }}"></script>

</body>

</html>
