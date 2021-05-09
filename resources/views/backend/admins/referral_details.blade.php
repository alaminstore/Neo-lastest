@extends('backend.home')
@section('title','Referral-Details')
@section('content')

    <div class="container">
        <div class="row">

            <div class=" offset-md-2 col-md-8">
                <div class="card">
                    <div class="card-header">
                        Details Info
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                @foreach ($user as $ref )

                                <h4>Referral Holder Info : </h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Name:</label>
                                        <p>{{$ref->name}}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Email Address:</label>
                                        <p>{{$ref->email}}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Contact Number:</label>
                                        <p>{{$ref->mobile_no}}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="offset-md-2  col-md-8">
                <div class="refferer_details">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center"># Serial</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Buy(tk)</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if($referrals)
                            <?php $count = 0;?>
                            @foreach($referrals as $referral )
                                <tr>
                                    <td class="text-center"><?php echo $count += 1; ?></td>
                                    <td class="text-center"> {{$referral['user']->name}}</td>
                                    <td class="text-center">
                                        @php
                                            for($i = 0; $i < count($keys);$i++){
                                                if($referral->user_id == $keys[$i]){
                                                    // echo $final[$i];
                                                    echo $final[$referral->user_id];
                                                }
                                            }
                                        @endphp
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td class="text-center" style="background: #B2B2B1;" colspan="2">Total Amount:</td>
                                <td class="text-center" style="background: #fff">{{number_format($total_amount, 2)}}</td>
                            </tr>
                            @endif

                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
