@extends('front.home')

@section('title','Address - Neo Bazaar')

@section('content')
    <div class="banner-wrapper has_background">
        <img src="{{asset('front')}}/assets/images/banner-for-all2.jpg"
             class="img-responsive attachment-1920x447 size-1920x447" alt="img">
        <div class="banner-wrapper-inner">
            <h1 class="page-title">Address</h1>
            <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb-trail breadcrumbs">
                <ul class="trail-items breadcrumb">
					<li class="trail-item trail-begin"><a href="{{url('/')}}"><span>Home</span></a></li>
					<li class="trail-item trail-begin"><a href="{{route('dashboard')}}"><span>Dashboard</span></a></li>
                    <li class="trail-item trail-end active"><span>Address</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <main class="site-main  main-container no-sidebar">
        <div class="container">
            <div class="row">
                <div class="main-content col-md-12">
                    <div class="page-main-content">
                        <div class="kreen">
                            @include('front.user.sidebar')
                            <div class="kreen-MyAccount-content">
                                <div class="kreen-notices-wrapper"></div>
                                <p>
                                    The following addresses will be used on the checkout page by default.</p>
                                <div class="u-columns kreen-Addresses col2-set addresses">
                                    <div class="u-column1 col-1 kreen-Address">
                                        <header class="kreen-Address-title title kreen-form-login-toggle kreen-form-toggle">
                                            <h3>Billing address</h3>
                                            @if($address)
                                                <a href="#" class="showlogin showbtn">Edit</a>
                                            @else
                                                <a href="#" class="showlogin showbtn">Add</a>
                                            @endif
                                        </header>
                                        <span class="kreen-form kreen-form-login login kreen-form-show" method="post" style="display: none;">
                                            <form method="post" action="{{route('address')}}">
                                                @csrf
                                                <p class="form-row form-row-first validate-required">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="input-text" name="name" id="name" autocomplete="name" value="{{$address ? $address->name : old('name') }}" required>
                                                </p>

                                                <p class="form-row form-row-last">
                                                    <label for="company">Company</label>
                                                    <input class="input-text" type="text" name="company" id="company" value="{{$address ? $address->company : old('company') }}" >
                                                </p>

                                                <p class="kreen-input-wrapper form-row form-row-first validate-required">
                                                    <label for="country">Country</label>
                                                    <select name="country"
                                                            id="country"
                                                            class="country_to_state country_select"
                                                            autocomplete="country"
                                                            tabindex="-1"
                                                            aria-hidden="true" required><option
                                                            value="">Select a country…</option><option
                                                            value="bangladesh" selected>Bangladesh</option>
                                                    </select>
                                                </p>

                                                <p class="form-row form-row-last validate-required">
                                                    <label for="district">District</label>
                                                    <span class="kreen-input-wrapper ">
                                                        <select name="district"
                                                                id="district"
                                                                class="district_to_state district_select"
                                                                autocomplete="district"
                                                                tabindex="-1"
                                                                aria-hidden="true" required>
                                                            <option value="">Select a district…</option>
                                                            @foreach($districts as $district)
                                                                <option  value="{{$district->district_id}}" {{$address ? ($address->district_id == $district->district_id ? 'selected' : '') : ''}}>
                                                                    {{$district->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </span>
                                                </p>
                                                <p class="form-row form-row-first validate-required">
                                                    <label for="city">City</label>
                                                    <input type="text" class="input-text" name="city" id="city" autocomplete="city" value="{{$address ? $address->city : old('city') }}" required>
                                                </p>

                                                <p class="form-row form-row-last validate-required">
                                                    <label for="zip_code">Zip Code</label>
                                                    <input class="input-text" type="text" name="zip_code" id="zip_code" value="{{$address ? $address->zip_code : old('zip_code') }}" required>
                                                </p>

                                                <p class="form-row form-row-wide validate-required">
                                                    <label for="house_and_street">House And Street</label>
                                                    <input type="text" class="input-text" name="house_and_street" id="house_and_street" autocomplete="house_and_street"
                                                           value="{{$address ? $address->house_and_street : old('house_and_street') }}" required>
                                                </p>


                                                <div class="clear"></div>
                                                <p class="form-row form-row-wide">
                                                    @if($address)
                                                        <button type="submit" class="button">Update</button>
                                                    @else
                                                        <button type="submit" class="button">Submit</button>
                                                    @endif
                                                </p>
                                                <div class="clear"></div>
                                             </form>
                                        </span>

                                        <address>
                                            <strong>Name:</strong> {{$address->name ?? ''}}<br>
                                            <strong>Company:</strong> {{$address->company ?? ''}}</br>
                                            <strong>Address: </strong>{{$address->house_and_street ?? ''}}, {{$address->city ?? ''}}, {{$address->district->name ?? ''}}, {{$address->country ?? ''}} - {{$address->zip_code ?? ''}}
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script>

    </script>
@endsection
