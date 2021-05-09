@extends('backend.home')
@section('title', 'Dashboard')
@section('content')
    {{--<h3>Filter recepies:</h3>--}}

    {{--<div>--}}
        {{--<p>Select seasoning</p>--}}
        {{--<label><input type="checkbox" id="seasoning[]" value="salt"> Salt</label><br>--}}
        {{--<label><input type="checkbox" id="seasoning[]" value="pepper"> Pepper</label><br>--}}
    {{--</div>--}}
@endsection


@section('scripts')
    <script type="text/javascript">
        // $(document).ready(function () {
        //     $('input[type=checkbox]').click(function (e) {
        //         var seasoning = jQuery.map($(':checkbox[id=seasoning\\[\\]]:checked'), function (n, i) {return n.value;}).join(',');
        //
        //         window.location ='example.com?seasoning='+seasoning;
        //
        //     });
        // });
    </script>
@endsection
