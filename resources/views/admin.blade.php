<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title')
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    @yield('styles')
    <style>
        .espero-soft-admin {
            background-color: #fafafa;
        }

        .espero-soft-admin .row {
            height: 100vh;
        }

        .espero-soft-admin a {
            /* color: inherit; */
            text-decoration: inherit;
        }

        .espero-soft-admin h2 {
            color: black;
            text-transform: uppercase;
        }

        .espero-soft-admin nav-item {}

        .btn {
            border-radius: 0;
        }
    </style>
</head>

<body>
    <div class="container-fluid espero-soft-admin">
        <div class="row gx-0 gy-0">
            <nav id="sidebar" class="col-md-2 border-end d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <a href="{{ route('home') }}">
                        <h2>{{ session()->get('setting')?->name }}</h2>
                    </a>
                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                {{ __('messages.mywebsite') }}
                                
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.category.index') }}">
                                {{ __('messages.categories') }}
                                
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.product.index') }}">
                                {{ __('messages.products') }}
                                
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.user.index') }}">
                                {{ __('messages.users') }}
                                
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.banner.index') }}">
                                {{ __('messages.banners') }}
                                
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.collection.index') }}">
                                {{ __('messages.collections') }}
                                
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.page.index') }}">
                                {{ __('messages.pages') }}
                                
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.tag.index') }}">
                                {{ __('messages.tags') }}
                                
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.megacollection.index') }}">
                                {{ __('messages.megaMenu') }}
                                
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.setting.index') }}">
                                {{ __('messages.settings') }}
                                
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.social.index') }}">
                                {{ __('messages.socials') }}
                                
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.contact.index') }}">
                                {{ __('messages.contacts') }}
                                
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.role.index') }}">
                                {{ __('messages.rolesUsers') }}
                             
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.carrier.index') }}">
                                {{ __('messages.carriers') }}
                                
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.address.index') }}">
                                {{ __('messages.addresses') }}
                                
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.page.index') }}">
                                Pages
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.method.index') }}">
                                {{ __('messages.methods') }}
                                
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.order.index') }}">
                                {{ __('messages.orders') }}
                                
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.orderdetails.index') }}">
                                {{ __('messages.orderdetails') }}
                                
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main id="main-content" class="col-md-10">
                <h2 class="border-bottom m-0 p-3">{{ __('messages.Dashboard') }}</h2>
                <div class="p-3">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    @yield('scripts')

</body>

</html>
