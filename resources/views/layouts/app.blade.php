<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<style>
    @media(min-width:768px) {
        body {
            margin-top: 50px;
        }
    }

    #wrapper {
        padding-left: 0;
    }

    #page-wrapper {
        width: 100%;
        padding: 0;
        background-color: #ffffff;
    }

    @media(min-width:768px) {
        #wrapper {
            padding-left: 225px;
        }

        #page-wrapper {
            padding: 22px 10px;
        }
    }

    .top-nav {
        padding: 0 15px;
    }

    .top-nav>li {
        display: inline-block;
        float: left;
    }

    .top-nav>li>a {
        padding-top: 20px;
        padding-bottom: 20px;
        line-height: 20px;
        color: #fff;
    }

    .top-nav>li>a:hover,
    .top-nav>li>a:focus,
    .top-nav>.open>a,
    .top-nav>.open>a:hover,
    .top-nav>.open>a:focus {
        color: #fff;
        background-color: #1a242f;
    }

    .top-nav>.open>.dropdown-menu {
        float: left;
        position: absolute;
        margin-top: 0;
        background-color: #fff;
        box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
    }

    .top-nav>.open>.dropdown-menu>li>a {
        white-space: normal;
    }

    @media(min-width:768px) {
        .side-nav {
            position: fixed;
            top: 60px;
            left: 225px;
            width: 225px;
            margin-left: -225px;
            border: none;
            border-radius: 0;
            border-top: 1px rgba(0, 0, 0, .5) solid;
            overflow-y: auto;
            background-color: #222;
            bottom: 0;
            overflow-x: hidden;
            padding-bottom: 40px;
        }

        .side-nav>li>a {
            width: 225px;
            border-bottom: 1px rgba(0, 0, 0, .3) solid;
        }

        .side-nav li a:hover,
        .side-nav li a:focus {
            outline: none;
            background-color: #330066 !important;
        }
    }

    .side-nav>li>ul {
        padding: 0;
        border-bottom: 1px rgba(0, 0, 0, .3) solid;
    }

    .side-nav>li>ul>li>a {
        display: block;
        padding: 10px 15px 10px 38px;
        text-decoration: none;
        color: #fff;
    }

    .side-nav>li>ul>li>a:hover {
        color: #fff;
    }

    .navbar .nav>li>a>.label {
        border-radius: 50%;
        position: absolute;
        top: 14px;
        right: 6px;
        font-size: 10px;
        font-weight: normal;
        min-width: 15px;
        min-height: 15px;
        line-height: 1.0em;
        text-align: center;
        padding: 2px;
    }

    .navbar .nav>li>a:hover>.label {
        top: 10px;
    }

    .navbar-brand {
        padding: 5px 15px;
    }


    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>404 Not Found</title><style>body {
        font-family: Arial, sans-serif;
        text-align: center;
        padding: 50px;
    }

    h1 {
        font-size: 50px;
    }

    p {
        font-size: 20px;
    }
</style>
</head>

<body>
    <h1>404</h1>
    <a href="/">Go back to homepage</a>
    </style>
    <div id="throbber" style="display:none; min-height:120px;"></div>
    <div id="noty-holder"></div>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="http://placehold.it/200x50&text=LOGO" alt="LOGO">
                </a>
            </div>
            <ul class="nav navbar-right top-nav">

                            class="fa fa-bar-chart-o"></i></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin User <b
                            class="fa fa-angle-down"></b></a>
                    <ul class="dropdown-menu">
                        <li class="text-center"><a href="#"><i class="fa fa-fw fa-user"></i> Edit Profile</a></li>

                        <li class="divider"></li>
                        <li class="text-center">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link"
                                    style="padding: 0; color: #333; text-decoration: none;">
                                    <li><a href="#">  <i class="fa fa-fw fa-power-off"></i> Logout</a></li>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a data-toggle="collapse" data-target="#submenu-1"><i class="fa fa-fw fa-search"></i>USERS<i
                                class="fa fa-fw fa-angle-down pull-right"></i></a>
                        <ul id="submenu-1" class="collapse">

                            <li><a href="{{ route('user.add') }}"><i class="fa fa-angle-double-right"></i> ADD USER</a>
                            </li>
                            <li><a href="{{ route('user.list') }}"><i class="fa fa-angle-double-right"></i> LIST USER</a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="#" data-toggle="collapse" data-target="#submenu-2"><i
                                class="fa fa-fw fa-star"></i>
                            CATEGORİES<i class="fa fa-fw fa-angle-down pull-right"></i></a>
                        <ul id="submenu-2" class="collapse">
                            <li><a href="{{ route('category.add') }}"><i class="fa fa-angle-double-right"></i> ADD
                                    CATEGORY</a></li>
                            <li><a href="{{ route('category.list') }}"><i class="fa fa-angle-double-right"></i>LIST
                                    CATEGORY</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" data-toggle="collapse" data-target="#submenu-3"><i
                                class="fa fa-fw fa-star"></i>
                            PRODUCTS<i class="fa fa-fw fa-angle-down pull-right"></i></a>
                        <ul id="submenu-3" class="collapse">
                            <li><a href="{{ route('product.add') }}"><i class="fa fa-angle-double-right"></i> ADD
                                    PRODUCT</a>
                            </li>
                            <li><a href="{{ route('product.list') }}"><i class="fa fa-angle-double-right"></i> LIST
                                    PRODUCT</a></li>

                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
        <div id="page-wrapper">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
            $(".side-nav .collapse").on("hide.bs.collapse", function() {
                $(this).prev().find(".fa").eq(1).removeClass("fa-angle-right").addClass("fa-angle-down");
            });
            $('.side-nav .collapse').on("show.bs.collapse", function() {
                $(this).prev().find(".fa").eq(1).removeClass("fa-angle-down").addClass("fa-angle-right");
            });
        })
    </script>
