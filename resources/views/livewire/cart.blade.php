<div>
    <button
            type="button"
            class="btn btn-primary w-100 rounded"
            data-toggle="modal" data-target="#shopCart"
    >
        <i class="bi bi-cart"></i> {{trans('shop.cart')}} <span class="badge badge-light">
        {{$count}}
    </span>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="shopCart" tabindex="-1" aria-labelledby="shopCartLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="shopCartLabel">{{trans('shop.cart')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card">

                        @foreach($items as $key => $item)
                            <div class="row">
                                <div class="col-12">
                                    #{{$key+1}}. {{$item->title}}
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="quantity_item" value="{{$item->quantity_items}}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    {{$item->currencyCode()}} {{$item->cart_price}}
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">{{trans('shop.order')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>