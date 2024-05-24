@extends('base')

@section('title')
    Dashboard {{ $site_title() }}
@endsection

@section('content')
    @include('jstore/components/top-page', ['title' => 'Dashboard'])

    @php
        $routeName = explode('.',Route::currentRouteName())[1]
    @endphp

    <div class="main_content">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible position-fixed bottom-0 end-0 m-3">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                {{ session('success') }}
            </div>
        @endif
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <div class="dashboard_menu">
                            <ul class="nav nav-tabs flex-column" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link @if($routeName === 'index') active @endif" id="dashboard-tab"
                                    href="{{ route('dashboard.index')}}"
                                        role="tab" aria-controls="dashboard" aria-selected="false">
                                        <i class="ti-layout-grid2"></i>
                                        {{ __("messages.dashboard") }}</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link @if($routeName === 'orders') active @endif" id="orders-tab"
                                    href="{{ route('dashboard.orders')}}" role="tab"
                                        aria-controls="orders" aria-selected="false">
                                        <i class="ti-shopping-cart-full"></i>
                                        {{ __("messages.order")}}</a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link @if($routeName === 'address') active @endif" id="address-tab"
                                    href="{{ route('dashboard.address')}}"
                                        role="tab" aria-controls="address" aria-selected="true">
                                        <i class="ti-location-pin"></i>
                                        {{ __("messages.myaddress")}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link  @if($routeName === 'account') active @endif" id="account-detail-tab"

                                    href="{{ route('dashboard.account')}}"
                                        role="tab" aria-controls="account-detail" aria-selected="true">
                                        <i class="ti-id-badge"></i>
                                        {{ __("messages.accountDetails")}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link @if($routeName === 'logout') active @endif" id="logout-tab"
                                    href="{{ route('dashboard.logout')}}"
                                    role="tab"
                                        aria-controls="logout" aria-selected="true">
                                        <i class="ti-lock"></i>
                                        {{ __("messages.logout")}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8">
                        <div class="tab-content dashboard_content">
                            <div class="tab-pane fade @if($routeName === 'index') active show @endif " id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>{{ __("messages.dashboard")}}</h3>
                                    </div>
                                    <div class="card-body">
                                        <p> {{ __("messages.text-dashboard")}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade @if($routeName === 'logout') active show @endif" id="logout" role="tabpanel" aria-labelledby="logout-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>{{ __("messages.logout")}}</h3>
                                    </div>
                                    <div class="card-body">
                                        <p>
                                            {{ __("messages.text-logout")}}
                                        </p>


                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-fill-out py-2" name="submit"
                                                value="Submit">{{ __("messages.logout")}}</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            {{-- <div class="tab-pane fade @if($routeName === 'orders') active show @endif" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>{{ __("messages.order")}}</h3>
                                    </div>
                                    <div class="card-body">
                                        @dump($orderInfo)
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __("messages.order")}}</th>
                                                        <th>Date</th>
                                                        <th>{{ __("messages.quantity")}}</th>
                                                        <th>Total</th>
                                                        <th>{{ __("messages.carrier")}}</th>
                                                        <th>{{ __("messages.carrier")}} {{ __("messages.price")}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                   
                                                    <td>#COM{{ $orderInfo->id }}</td>
                                                    <td>{{ $orderInfo->created_at }}</td>
                                                    <td style="text-align: center">{{ $orderInfo->quantity }}</td>
                                                    <td>{{ $format_price($orderInfo->order_cost_ttc)}}</td>
                                                    <td>{{ $orderInfo->carrier_name }}</td>
                                                    <td>{{ $orderInfo->carrier_price }}</td>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="tab-pane fade @if($routeName === 'address') active show @endif" id="address" role="tabpanel"
                                aria-labelledby="address-tab">
                                {{-- <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card mb-3 mb-lg-0">
                                            <div class="card-header">
                                                <h3>Billing Address</h3>
                                            </div>
                                            <div class="card-body">
                                                <address>House #15<br>Road #1<br>Block #C <br>Angali <br> Vedora <br>1212</address>
                                                <p>New York</p>
                                                <a href="#" class="btn btn-fill-out">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3>Shipping Address</h3>
                                            </div>
                                            <div class="card-body">
                                                <address>House #15<br>Road #1<br>Block #C <br>Angali <br> Vedora <br>1212</address>
                                                <p>New York</p>
                                                <a href="#" class="btn btn-fill-out">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="card">
                                    <div class="card-header">
                                        <h3>{{ __("messages.address")}}</h3>
                                        <a class="btn btn-fill-out btn-sm" href="{{ route('dashboard.address.add') }}">
                                            {{ __("messages.addAddress")}}
                                        </a>
                                    </div>
                                    @if (isset($action) && Str::startsWith($action, 'address.'))
                                        <div class="p-2">
                                            @include('addresses/addressFormFont')
                                        </div>
                                    @else
                                        @if ($user->addresses->count())
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>{{ __('messages.name') }}</th>
                                                                <th>Type</th>
                                                                <th> {{ __('messages.address') }}</th>
                                                                <th>{{ __("messages.state") }}</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($user->addresses as $address)
                                                                <tr>
                                                                    <td>#{{ $address->id }}</td>
                                                                    <td>{{ $address->name }}</td>
                                                                    <td>{{ $address->addressType }}</td>
                                                                    <td>{{ $address->street }} {{ $address->city }}
                                                                        {{ $address->codePostal }} </td>

                                                                    <td>{{ $address->state }}</td>
                                                                    <td>
                                                                        <div class="d-flex gap-1">

                                                                            <a href="{{ route('dashboard.address.edit', ['id' => $address->id]) }}"
                                                                                class="btn btn-fill-out btn-sm"> {{ __('messages.edit') }}</a>

                                                                            <form
                                                                                action="{{ route('dashboard.address.delete', ['id' => $address->id]) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button class="btn btn-fill-out btn-sm">
                                                                                    {{ __('messages.delete') }}
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @else
                                            <p class="p-2">
                                               {{__('messages.text-myaddress')}}
                                            </p>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade  @if($routeName === 'account') active show @endif" id="account-detail" role="tabpanel"
                                aria-labelledby="account-detail-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h3> {{ __("messages.accountDetails") }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ __("messages.text-accountDetails") }}</p>
                                        <form class="card mb-2 p-2 border" action="{{route('dashboard.profile.update')}}" method="post" name="enq">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="form-group col-md-12 mb-3">
                                                    <label>{{ __("messages.name") }} <span class="required">*</span></label>
                                                    <input required="" value="{{old('name', $user->name)}}" class="form-control" name="name"
                                                        type="text">
                                                </div>

                                                <div class="form-group col-md-12 mb-3">
                                                    <label>Email Address <span class="required">*</span></label>
                                                    <input value="{{old('email', $user->email)}}" required="" class="form-control" name="email"
                                                        type="email">
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-fill-out"
                                                        value="Submit">{{ __("messages.update") }} </button>
                                                </div>
                                            </div>
                                        </form>


                                        <form class="card mb-2 p-2 border"  action="{{route('dashboard.profile.update.password')}}"  method="post">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group col-md-12 mb-3">
                                                <label>{{ __('messages.currentPassword ') }} <span class="required">*</span></label>
                                                <input value="{{old('password', '')}}"  class="form-control" name="password"
                                                    type="password">
                                                    @error('password')
                                                        <div class="error text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                            </div>
                                            <div class="form-group col-md-12 mb-3">
                                                <label>{{ __('messages.newPassword ') }}<span class="required">*</span></label>
                                                <input value="{{old('npassword', '')}}"  class="form-control" name="npassword"
                                                    type="password">
                                                    @error('npassword')
                                                        <div class="error text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                            </div>
                                            <div class="form-group col-md-12 mb-3">
                                                <label>{{ __('messages.confirmPassword ') }}  <span class="required">*</span></label>
                                                <input value="{{old('cpassword', '')}}"  class="form-control" name="cpassword"
                                                    type="password">
                                                    @error('cpassword')
                                                        <div class="error text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-fill-out" name="submit"
                                                    value="Submit">{{ __("messages.save") }} </button>
                                            </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
