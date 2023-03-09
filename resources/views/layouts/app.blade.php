<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SPP APP - SMAIT As-Syifa Boarding School</title>
    <link rel="icon" type="image/x-icon" href="../../../public/favicon.ico">


    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" integrity="sha512-a9NgEEK7tsCvABL7KqtUTQjl69z7091EVPpw5KxPlZ93T141ffe1woLtbXTX+r2/8TtTvRX/v4zTL2UlMUPgwg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.min.js" integrity="sha512-P0bOMePRS378NwmPDVPU455C/TuxDS+8QwJozdc7PGgN8kLqR4ems0U/3DeJkmiE31749vYWHvBOtR+37qDCZQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" integrity="sha512-XMVd28F1oH/O71fzwBnV7HucLxVwtxf26XV8P4wPk26EDxuGZ91N8bsOttmnomcCD3CS5ZMRL50H0GgOHvegtg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<style type="text/css" media="print">
    @media print {
        body * {
            visibility: hidden;
        }
        #modalReceipt * {
            visibility: visible;
            overflow: hidden;
            max-width: 100%;
            width: 100%;
        }
        #hide * {
            display: none;
        }
        /* .modal-body * {
            position: fixed;
        } */
        #receiptFooter * {
            display: none;
        }
        #section-to-print {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
  </style>
<body style="padding-top: 65px;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light fixed-top  shadow-sm" style="background-color: #e3f2fd;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    SPP APP - ASBOSCH
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            @if (auth()->user()->level == 'admin')
                                <li class="nav-item">
                                    <a href="{{url('tuition')}}" class="nav-link">SPP</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('class')}}" class="nav-link">Kelas</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('student')}}" class="nav-link">Siswa</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('mutation')}}" class="nav-link">Mutasi</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('payment')}}" class="nav-link">Pembayaran</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('user')}}" class="nav-link">User</a>
                                </li>
                            @elseif (auth()->user()->level == 'treasurer')
                                <li class="nav-item">
                                    <a href="{{url('payment')}}" class="nav-link">Pembayaran</a>
                                </li>
                            @elseif (auth()->user()->level == 'student')
                                <li class="nav-item">
                                    <a href="{{url('history')}}" class="nav-link">Riwayat</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<footer class="bg-dark text-center text-white">
    <div class="text-center p-5" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2023 Copyright: RPL Wikrama
    </div>
</footer>
<script>
$(document).ready( function () {
    $('.table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                filename: "Data"
            }, {
                extend: 'pdf',
                filename: "Data"
            }
        ],
    });

    $('.select2').select2({
        dropdownParent: $('#modal'),
        theme: 'bootstrap-5'
    });
});

$('.number').keyup(function(){
    var sanitized = $(this).val().replace(/[^0-9]/g, '');
    $(this).val(sanitized);
});
</script>
@yield('script')
</html>
