@extends('front.layout.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.shop') }}">Shop</a></li>
                    <li class="breadcrumb-item">{{ $product-> name }}</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-7 pt-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-5">
                    <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner bg-light">

                            @if($product->product_images)
                                @foreach($product->product_images as $key => $productImage)
                                    <div class="carousel-item {{ ($key == 0) ? 'active' : ''}}">
                                        <img class="w-100 h-100" src="{{ asset('upload/category/'.$productImage->image) }}" alt="Image">
                                    </div>
                                @endforeach
                            @endif

                        </div>
                        <a class="carousel-control-prev" href="#product-carousel" data-bs-slide="prev">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-bs-slide="next">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="bg-light right">
                        <h1>{{ $product-> name }}</h1>
                        <div class="d-flex mb-3">
                            <div class="text-primary mr-2">
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star-half-alt"></small>
                                <small class="far fa-star"></small>
                            </div>
                            <small class="pt-1">(99 Reviews)</small>
                        </div>
                        <div class="d-flex mb-3">
                        @if($product->compare_price > 0)
                            <h2 class="price text-secondary"><del>${{ $product->compare_price }}</del></h2> &nbsp;
                        @endif
                            <h2 class="price ">${{ $product->price }}</h2>
                        </div>
                        @if($product->track_qty == 'YES')
                            @if($product->qty > 0)
                                <a class="btn btn-dark" href="javascript:void(0);"
                                   onclick="addToCart({{ $product->id }})">
                                    <i class="fa fa-shopping-cart"></i> &nbsp; Add To Cart
                                </a>
                            @else
                                <a class="btn btn-dark" href="javascript:void(0);">
                                    &nbsp; Out of stock
                                </a>
                            @endif
                        @else
                            <a class="btn btn-dark" href="javascript:void(0);">
                                &nbsp; Out of stock
                            </a>
                        @endif
                        <p style="font-size: 18px">{!! $product->short_description !!}</p>

                    </div>
                </div>

                <div class="col-md-12 mt-5">
                    <div class="bg-light">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab" aria-controls="shipping" aria-selected="false">Shipping & Returns</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                {!! $product->description !!}
                            </div>
                            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                                {!! $product->shipping_returns !!}
                            </div>
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(!empty($relatedProducts))
    <section class="pt-5 section-8">
        <div class="container">
            <div class="section-title">
                <h2>Related Products</h2>
            </div>
            <div class="col-md-12">
                <div id="related-products" class="carousel">
                        @foreach($relatedProducts as $relatedProduct)
                        @php
                            $productImage = $relatedProduct->product_images->first();
                        @endphp
                    <div class="card product-card">
                        <div class="product-image position-relative">
                            <a href="" class="product-img">

                                @if(!empty($productImage->image))
                                    <img src="{{ asset('upload/category/'.$productImage->image) }}" class="card-img-top img-thumbnail" >
                                @else
                                    <img src="{{ asset('admin-assets/img/default-150x150.png') }}" class="img-thumbnail">
                                @endif
                            </a>
                            <a class="whishlist" href="222"><i class="far fa-heart"></i></a>

                            <div class="product-action">
                                @if($relatedProduct->track_qty == 'YES')
                                    @if($relatedProduct->qty > 0)
                                        <a class="btn btn-dark" href="javascript:void(0);"
                                           onclick="addToCart({{ $relatedProduct->id }})">
                                            <i class="fa fa-shopping-cart"></i> Add To Cart
                                        </a>
                                    @else
                                        <a class="btn btn-dark" href="javascript:void(0);">
                                            Out of stock
                                        </a>
                                    @endif
                                @else
                                    <a class="btn btn-dark" href="javascript:void(0);">
                                        Out of stock
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body text-center mt-3">
                            <a class="h6 link" href="">{{ $relatedProduct->name }}</a>
                            <div class="price mt-2">
                                <span class="h5"><strong>${{ $relatedProduct->price }}<</strong></span>
                                @if($relatedProduct->compare_price > 0)
                                    <span class="h6 text-underline"><del>${{ $relatedProduct->compare_price }}</del></span>
                                @endif
                            </div>
                        </div>
                    </div>
                        @endforeach

                </div>
            </div>
        </div>
    </section>
    @endif
@endsection

