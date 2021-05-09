@extends('front.home')

@section('title','Verify Mail')
<style>
    .inner_portion{
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        min-height: 500px;
        text-align: center;
    }
</style>
@section('content')
<div class="verify">
    <div class="col-md-12">
        <div class="container">
            <div class="inner_portion">
                <h3>A mail has been sent to your email account, please verify your email to Login.</h3>
            </div>
        </div>
    </div>
</div>
@endsection
