@extends('frontend.include.master')
@section('body')
<div class="container mt-3">
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div style="display: flex; justify-content: center;">
                <div class="thumbnail-images">
                    @foreach ($thamnails as $thumbnail)
                        <img class="product-thumbnail" src="{{asset('images/products/thumbnail/'.$thumbnail->thumbnail)}}" alt="Product thumbnail 1" onclick="changeMainImage('{{asset('images/products/thumbnail/'.$thumbnail->thumbnail)}}')">
                    @endforeach
                </div>
                <div class="product-gallery">
                    <div class="main-image">
                        <a href="#"><img id="mainImage" class="product-main-img" src="{{asset('images/products/preview/'.$product_info->preview)}}" alt="Main product image"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="product__details__text">
                <form action="{{route('checkout')}}" method="POST">
                 @csrf
                    <h3 class="mt-3">{{$product_info->name}}</h3>
                    <input type="hidden" name="product_id" value="{{ $product_info->id }}">
                    <div class="product__details__price fs-3"><span class="text-danger me-2">ট {{$product_info->after_discount}}</span> <del>{{$product_info->price}}</del></div>


                    <div class="bttn" style="max-width: 400px;">
                        <div class="row">
                            <div class="col-md-4 col-12 mb-2">
                                <div class="article">
                                    <button type="button" class="button-design buttonminus">-</button>
                                    <input type="text" name="quantity" class="button-design" id="quantity1" value="1">
                                    <button type="button" class="button-design buttonplus">+</button>
                                </div>
                            </div>
                            <div class="col-md-8 col-12">
                                <div class="order-container">
                                    <button type="submit" name="click" value="1" class="btn w-100 text-white" style="background-color: #E2B01F;">Order Now</button>
                                </div>
                            </div>
                        </div>
                    </form>
                        <form action="{{route('add.cart')}}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product_info->id }}">
                            <input type="hidden" name="quantity" value="1" />
                            <button type="submit" class="btn w-100 mt-3 text-white" style="background-color: #FA8500;">Add Cart</button>
                            <button class="btn w-100 mt-3 mb-2 text-white" style="background-color: #2446f2;">  
                                01725003963</button>
                            </form>
                    </div>
                    <ul>
                        <li><b>Share on</b>
                            <div class="share">
                                <a href="#"><i class="fab fa-facebook"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            </div>
                        </li>
                    </ul>
            </div>
        </div>
    </div>
</div>

<div class="bg-light">
    <div class="container mt-3">
        <h3 class="p-3">Product Description</h3>
        <p>{!!$product_info->long_desp!!}</p>
        <div class="d-flex justify-content-center flex-wrap">
            @foreach ($thamnails as $thumbnail)
                <img src="{{asset('images/products/thumbnail/'.$thumbnail->thumbnail)}}" class="img-fluid mb-3" alt="">
            @endforeach
        </div>
        <div class="video-container">
            <iframe src="https://www.youtube.com/embed/7VwszeAogOI" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>

<div class="mb-5 mt-5 container">
    <div class="ptoduct-title fs-3">
        Poducts
    </div>
    <div class="product-list container2">
        @foreach ($products as $product)
        <div class="card cardhover">
            <a href="{{route('details',$product->slug)}}">
                <img class="img-fluid" src="{{asset('images/products/preview/'.$product->preview)}}" alt="Product Image">
            </a>
            <div class="card-body">
                <a href="{{route('details',$product->slug)}}">
                    <p class="card-text">{{$product->name}}</p>
                </a>
                <p class="price">{{$product->after_discount}}</p>
                <p class="original-price"><del>{{$product->price}}</del> -{{$product->discount}}</p>
                <div class="rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i> (40)
                </div>
            </div>
        </div>
       @endforeach
    </div>
</div>

@endsection
@push('js')
@if (session('success'))
    <script>
        Toastify({
            text: "{{ session('success') }}",
            duration: 5000,
            close: true,
            stopOnFocus: true,
            backgroundColor: "rgba(40, 167, 69, 0.9)",
            // Explicitly setting the bottom-right position
            position: "right", // Align to the right
            gravity: "bottom"  // Position at the bottom
        }).showToast();
    </script>
@endif
@endpush
