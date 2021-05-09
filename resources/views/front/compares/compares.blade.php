@extends('front.home')

@section('title','Compare - Coastalino')

@section('content')

    <!-- page title area start -->
    <section class="page__title p-relative d-flex align-items-center" data-background="{{asset('front')}}/assets/img/page-title/page-title-1.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page__title-inner text-center">
                        <h1>Compare</h1>
                        <div class="page__title-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{route('front')}}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('shop')}}">Shop</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Compare</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page title area end -->
    @if(count($compare_products) > 0)
        <!-- Compare Area Strat-->
        <section class=" pt-100 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-content table-responsive compare-area">
                                <table class="table">
                                    <tbody>

                                        <tr>
                                            <th>Product Name</th>
                                            @foreach($compare_products as $compare_product)
                                                <td>
                                                    <img src="{{$compare_product->image}}" alt="{{$compare_product->name}}" >
                                                    <p>{{$compare_product->name}}</p>
                                                </td>
                                            @endforeach

                                        </tr>

                                        <tr>
                                            <th>Price</th>
                                            @foreach($compare_products as $compare_product)
                                                <td>{{$currency_symbol}} {{$compare_product->sales_price ? $compare_product->sales_price : $compare_product->regular_price}}</td>
                                            @endforeach
                                        </tr>

                                        <tr class="action">
                                            <th>Action</th>
                                            @foreach($compare_products as $compare_product)
                                                <td><a href="{{route('compares.remove',$compare_product->id)}}"><i class="fas fa-trash-alt" ></i></a></td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th>Category</th>
                                            @foreach($compare_products as $compare_product)
                                                <td>{{$compare_product->category->category_name}}</td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Compare Area End-->
    @else
        <section class=" pt-100 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="text-center">There are no products to compare. You need to add some products to the comparison list before view.</p>
                        <a href="{{route('shop')}}" class="os-btn os-btn-black text-center" >RETURN TO SHOP</a>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection