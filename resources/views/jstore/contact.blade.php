@extends('base')

@section('title')
    Contact page {{ $site_title() }}
@endsection

@section('content')
    @include('jstore/components/top-page', ['title' => 'Contact Form'])
    <div class="container">

        <div class="main_content">

            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="section pb_70">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="contact_wrap contact_style3">
                                <div class="contact_icon">
                                    <i class="linearicons-map2"></i>
                                </div>
                                <div class="contact_text">
                                    <span>{{ __('messages.address') }}</span>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="contact_wrap contact_style3">
                                <div class="contact_icon">
                                    <i class="linearicons-envelope-open"></i>
                                </div>
                                <div class="contact_text">
                                    <a href="mailto: {{ session()->get('setting')?->email }}"> 
                                        <span>{{ __('messages.email') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="contact_wrap contact_style3">
                                <div class="contact_icon">
                                    <i class="linearicons-tablet2"></i>
                                </div>
                                <div class="contact_text">
                                    <span>{{ __('messages.phone') }}</span>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section pt-0">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="heading_s1">
                                <h2>{{ __('messages.text-contact') }}</h2>
                            </div>
                            <p class="leads">{{ __('messages.p-contact') }}</p>
                            <div class="field_form">
                                @include('contacts/contactFrontForm')
                                {{-- <form method="post" name="enq">
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    <input required placeholder="Enter Name *" id="first-name" class="form-control"
                                        name="name" type="text">
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <input required placeholder="Enter Email *" id="email" class="form-control"
                                        name="email" type="email">
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <input required placeholder="Enter Phone No. *" id="phone" class="form-control"
                                        name="phone">
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <input placeholder="Enter Subject" id="subject" class="form-control" name="subject">
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    <textarea required placeholder="Message *" id="description" class="form-control"
                                        name="message" rows="4"></textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <button type="submit" title="Submit Your Message!" class="btn btn-fill-out"
                                       name="submit" value="Submit">Send Message</button>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div id="alert-msg" class="alert-msg text-center"></div>
                                </div>
                            </div>
                        </form> --}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>

    </div>
@endsection
