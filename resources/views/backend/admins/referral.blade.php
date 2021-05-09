@extends('backend.home')
@section('title','Referral')
@section('content')
    <div class="container">
        <div class="row">
            <div class="offset-md-2 col-md-8">
                <h4>Referral Link</h4>
                <div class="refferal_table">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">#</th>
                            <th scope="col" class="text-center">ReferraL</th>
                            <th scope="col" class="text-center">Link</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 0; ?>

{{--                        @foreach($referral->unique('referrer') as $refer)--}}
                        @foreach($referral->unique('referrer') as $refer)

                            <?php $i++ ?>
                        <tr>
                            <th scope="row" class="text-center">{{$i}}</th>
                            <td class="text-center">{{$refer->referrer}}</td>
                            <td class="text-center">
                                {{-- <a href="{{route('admin.referral.details', $refer->referrer)}}"> --}}
                                <a href="{{route('admin.referral.details', \Crypt::encrypt($refer->referrer))}}">

                                  <button class="btn btn-outline-primary">
                                      View &nbsp; <i class="ti-eye menu-icon"></i>
                                  </button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
