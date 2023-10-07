<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>{{ SITE_NAME }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Test Laravel" name="description" />
        <meta content="Hardeep" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="/assets/images/favicon.ico">

        <link rel="stylesheet"  type="text/css" href="/assets/css/app.min.css"  />
        <link rel="stylesheet"  type="text/css" href="/assets/css/bootstrap.min.css"  />
        <link rel="stylesheet"  type="text/css" href="/assets/css/preloader.min.css"/>
        <link rel="stylesheet"  type="text/css" href="/assets/css/icons.min.css" />

        <link rel="stylesheet"  type="text/css" href="/assets/libs/select2/select2.min.css" />
        <link rel="stylesheet"  type="text/css" href="/assets/libs/select2/select2-bootstrap.min.css"/>
        
        <link rel="stylesheet"  type="text/css" href="/assets/libs/sweetalert2/sweetalert2.min.css" />
        
        <!-- Project related CSS -->
        <link rel="stylesheet"  type="text/css" href="/css/backend/default.css?<?= BACKEND_CSS_JS_VERSION ?>" />

        <!-- Pre javascript -->
        <script src="/assets/libs/jquery/jquery.min.js"></script>
        <script src="/js/backend/constants.js?<?= BACKEND_CSS_JS_VERSION ?>"></script>
        <script src="/js/backend/setup.js?<?= BACKEND_CSS_JS_VERSION ?>"></script>
    </head>

    <body>
        <!-- Begin page -->
        <div id="layout-wrapper">

            <x-backend.header/>

            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <x-backend.menu-show/>
                </div>
            </div>

            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <x-backend.session-flash />

                        @yield('content')

                    </div>
                </div>

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © <?= SITE_NAME ?>.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Develop by <a href="#!" class="text-decoration-underline"><?= SITE_DEVELOP_BY ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <script type="text/javascript"  src="/assets/libs/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript"  src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript"  src="/assets/libs/bootbox/5.5.3/bootbox.min.js"></script>
        <script type="text/javascript"  src="/assets/libs/metismenu/metisMenu.min.js"></script>
        <script type="text/javascript"  src="/assets/libs/simplebar/simplebar.min.js"></script>
        <script type="text/javascript"  src="/assets/libs/node-waves/waves.min.js"></script>
        <script type="text/javascript"  src="/assets/libs/feather-icons/feather.min.js"></script>
        <script type="text/javascript"  src="/assets/libs/pace-js/pace.min.js"></script>
        <script type="text/javascript"  src="/assets/libs/select2/select2.min.js"></script>
        <script type="text/javascript"  src="/assets/libs/apexcharts/apexcharts.min.js"></script>
        <script type="text/javascript"  src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>
        <script type="text/javascript"  src="/assets/js/app.js"></script>

        <!-- Basic JS Required -->
        <script type="text/javascript"  src="/js/basic_functions.js?<?= BACKEND_CSS_JS_VERSION ?>"></script>
        <script type="text/javascript"  src="/js/jquery-input-validate.js?<?= BACKEND_CSS_JS_VERSION ?>"></script>
        <script type="text/javascript"  src="/js/jquery-extend.js?<?= BACKEND_CSS_JS_VERSION ?>"></script>
        <script type="text/javascript"  src="/js/bootstrap-extend.js?<?= BACKEND_CSS_JS_VERSION ?>"></script>

        <!-- Project related JS -->
        
        <script type="text/javascript"  src="/js/backend/default.js?<?= BACKEND_CSS_JS_VERSION ?>"></script>

        <script type="text/javascript">
            $("body").srLoader();
        </script>
    </body>

</html>