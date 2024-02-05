<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <title>Multi-step Form in Laravel 9</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"
        integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .form-section {
            display: none;
        }

        .form-section.current {
            display: inline;
        }

        .parsley-errors-list {
            color: red;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
        <div class="container-fluid  ">
            <div class="row justify-content-md-center">
                <div class="col-md-9 ">
                    <div class="card px-5 py-3 mt-5 shadow">
                        <h1 class="text-danger text-center mt-3 mb-4">Form register customer</h1>
                        <div class="nav nav-fill my-3">
                            <label class="nav-link shadow-sm step0    border ml-2 ">Personal Information</label>
                            <label class="nav-link shadow-sm step1   border ml-2 ">Plan pay</label>
                            <label class="nav-link shadow-sm step2   border ml-2 ">Pay</label>
                        </div>
                        <form action="/post" method="post" class="employee-form">
                            @csrf
                            <div class="form-section">
                                <label for="">Name:</label>
                                <input type="text" class="form-control mb-3" name="name" required>
                                <label for="">Last Name:</label>
                                <input type="text" class="form-control mb-3" name="last_name" required>
                                <label for="">E-mail:</label>
                                <input type="email" class="form-control mb-3" name="email" required>
                                <label for="">Phone:</label>
                                <input type="tel" class="form-control mb-3" name="phone" required>
                            </div>
                            {{-- seccion select plan --}}
                            <div class="form-section">
                                <div class="row">
                                    @foreach ($plans as $plan)
                                        <div class="col-md-4">
                                            <div class="card border-primary mb-3" style="cursor: pointer;"
                                                onclick="toggleRadio(this)">

                                                <div class="card-header">{{ $plan->name }}</div>
                                                <div
                                                    class="card-body text-primary d-flex flex-column  justify-content-center align-items-center">
                                                    <h4 class="card-text">{{ $plan->description }}</h4>
                                                    <h2 class="card-text mb-5">${{ $plan->price }}</h2>
                                                    <input type="radio" class="form-check-input mt-5 p-2 plan-radio"
                                                        name="selected_plan" value="{{ $plan->id }}"
                                                        data-price="{{ $plan->price }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <input type="hidden" name="selected_plan_price" id="selected_plan_price" value="">
                            {{-- seccion pay --}}
                            <div class="form-section">
                                <label for="">Number Card:</label>
                                <input type="text" class="form-control mb-3" name="card_number" required>
                                <label for="">Time expired:</label>
                                <input type="text" class="form-control mb-3" name="exp_time" required>
                                <label for="">Type pay:</label>
                                <input type="text" class="form-control mb-3" name="type_pay" required>
                                <label for="">Code card:</label>
                                <input type="text" class="form-control mb-3" name="code_card" required>
                                <label for="">Price:</label>
                                <input type="text" class="form-control mb-3" name="price" required>
                            </div>
                            <div class="form-navigation mt-3">
                                <button type="button" class="previous btn btn-primary float-left">&lt;
                                    Previous</button>
                                <button type="button" class="next btn btn-primary float-right">Next &gt;</button>
                                <button type="submit" class="btn btn-success float-right">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function updatePrice(element) {
                var selectedPlanPrice = $(element).find('input[type="radio"]').data('price');
                $('input[name="price"]').val(selectedPlanPrice);
            }

            $(function() {
                var $sections = $('.form-section');

                function navigateTo(index) {
                    $sections.removeClass('current').eq(index).addClass('current');
                    $('.form-navigation .previous').toggle(index > 0);
                    var atTheEnd = index >= $sections.length - 1;
                    $('.form-navigation .next').toggle(!atTheEnd);
                    $('.form-navigation [Type=submit]').toggle(atTheEnd);
                    const step = document.querySelector('.step' + index);
                    step.style.backgroundColor = "#17a2b8";
                    step.style.color = "white";
                }

                function curIndex() {
                    return $sections.index($sections.filter('.current'));
                }
                $('.form-navigation .previous').click(function() {
                    navigateTo(curIndex() - 1);
                });
                $('.form-navigation .next').click(function() {
                    var selectedPlan = $('input[name="selected_plan"]:checked');
                    if (selectedPlan.length) {
                        updatePrice(selectedPlan.parent());
                    }
                    $('.employee-form').parsley().whenValidate({
                        group: 'block-' + curIndex()
                    }).done(function() {
                        navigateTo(curIndex() + 1);
                    });
                });
                $sections.each(function(index, section) {
                    $(section).find(':input').attr('data-parsley-group', 'block-' + index);
                });
                navigateTo(0);
            });
        </script>
    </div>
</body>

</html>
