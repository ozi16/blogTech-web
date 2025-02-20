@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Document title')
@section('meta_tags')
    {!!SEO::generate()!!}
@endsection
@section('content')

<div class="row">
    <div class="col-12">
        <h2 class="contact-title">Get in Touch</h2>
    </div>
    <div class="col-lg-8">
        <form class="form-contact contact_form" action="{{route('send_email')}}" method="POST" id="contactForm" novalidate="novalidate">
            @csrf
            <x-form-alerts></x-form-alerts>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder=" Enter Message"></textarea>
                        @error('message')
                            <span class="text-danger ml-1">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input class="form-control valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name" fdprocessedid="l3praz7">
                        @error('name')
                            <span class="text-danger ml-1">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input class="form-control valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email" fdprocessedid="hbwla">
                        @error('email')
                            <span class="text-danger ml-1">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <input class="form-control" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'" placeholder="Enter Subject" fdprocessedid="eew5nr">
                        @error('subject')
                            <span class="text-danger ml-1">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group mt-3">
                <button type="submit" class="button button-contactForm boxed-btn">Send</button>
            </div>
        </form>
    </div>
    <div class="col-lg-3 offset-lg-1">
        <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-home"></i></span>
            <div class="media-body">
                <h3>Buttonwood, California.</h3>
                <p>Rosemead, CA 91770</p>
            </div>
        </div>
        <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
            <div class="media-body">
                <h3>+1 253 565 2365</h3>
                <p>Mon to Fri 9am to 6pm</p>
            </div>
        </div>
        <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-email"></i></span>
            <div class="media-body">
                <h3>support@colorlib.com</h3>
                <p>Send us your query anytime!</p>
            </div>
        </div>
    </div>
</div>

@endsection