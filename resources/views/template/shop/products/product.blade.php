@extends('template.layouts.main', [
    'title' => $item->seo_title ?? $item->title,
    'seoDescription' => $item->seo_description,
    'seoKeyWords' => $item->seo_text_keys,
    'seoAuthor' => $item->user->name,
//    'sidebar' => false,
    ])

@section('content')
    <div class="row p-3">
        <div class="col-12">
            <div class="breadcrumbs mb-4">
                <a href="{{homeLink()}}">Home</a>
                <span class="mx-1">/</span>
                <a href="{{route('shop-index')}}">{{trans('shop.shop')}}</a>
                <span class="mx-1">/</span>
                <a href="{{route('shop-cart')}}">{{trans('shop.product')}}</a>
            </div>
        </div>
    </div>

    <!-- content -->
    <section class="py-5">
        <div class="container">
            <div class="row gx-5">
                <aside class="col-lg-6">
                    <div class="border rounded-4 mb-3 d-flex justify-content-center">
                        <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big.webp">
                            <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big.webp" />
                        </a>
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                        <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big1.webp" class="item-thumb">
                            <img width="60" height="60" class="rounded-2" src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big1.webp" />
                        </a>
                        <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big2.webp" class="item-thumb">
                            <img width="60" height="60" class="rounded-2" src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big2.webp" />
                        </a>
                        <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big3.webp" class="item-thumb">
                            <img width="60" height="60" class="rounded-2" src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big3.webp" />
                        </a>
                        <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big4.webp" class="item-thumb">
                            <img width="60" height="60" class="rounded-2" src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big4.webp" />
                        </a>
                        <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big.webp" class="item-thumb">
                            <img width="60" height="60" class="rounded-2" src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big.webp" />
                        </a>
                    </div>
                    <!-- thumbs-wrap.// -->
                    <!-- gallery-wrap .end// -->
                </aside>
                <main class="col-lg-6">
                    <div class="ps-lg-3">
                        <h4 class="title text-dark">
                            {{$item->title}}
                        </h4>
                        <div class="d-flex flex-row my-3">
                            <div class="text-warning mb-1 me-2">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="ms-1">
                4.5
              </span>
                            </div>
                            <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i>154 orders</span>
                            <span class="text-success ms-2">In stock</span>
                        </div>

                        <div class="mb-3">
                            <span class="h5">{{$item->currencyCode()}} {{$item->price}}</span>
                            <span class="text-muted">/per box</span>
                        </div>

                        <p>
                            {!! $item->short !!}
                        </p>

                        <div class="row">
                            <dt class="col-3">Type:</dt>
                            <dd class="col-9">Regular</dd>

                            <dt class="col-3">Color</dt>
                            <dd class="col-9">Brown</dd>

                            <dt class="col-3">Material</dt>
                            <dd class="col-9">Cotton, Jeans</dd>

                            <dt class="col-3">Brand</dt>
                            <dd class="col-9">Reebook</dd>
                        </div>

                        <hr />

                        <div class="row mb-4">

                            <div class="form-group col-md-4 col-4">
                                <label for="exampleFormControlSelect1">Example select</label>
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>

                            <div class="form-group ol-md-4 col-4">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity">
                            </div>
                        </div>
                        <button type="button" class="btn btn-warning btn-sm">Buy now </button>
                        <a href="#" class="btn btn-success btn-sm"> <i class="bi bi-cart"></i> Add to cart </a>
                        <a href="#" class="btn btn-secondary btn-sm"> <i class="bi bi-bag-heart"></i>   Save </a>
                    </div>
                </main>
            </div>
        </div>
    </section>
    <!-- content -->

    <section class="card article-card w-100">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item mx-1" role="presentation">
                <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                    {{trans('shop.description')}}
                </button>
            </li>
            <li class="nav-item mx-1" role="presentation">
                <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                    {{trans('shop.characteristic')}}
                </button>
            </li>
            <li class="nav-item mx-1" role="presentation">
                <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">
                    {{trans('dashboard.comments')}}
                </button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade my-2 show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <p>
                    {!! $item->content !!}
                </p>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <table class="table border mt-3 mb-2">
                    @foreach($item->characteristics() as $key => $value)
                        <tr>
                            <th class="py-2">{{$key}}</th>
                            <td class="py-2">{{$value}}</td>
                        </tr>
                    @endforeach

                </table>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="my-3">
                    <x-comments :item="$item"/>
                </div>

            </div>
        </div>
    </section>

@endsection
