@extends('template.layouts.main', [
    'title' => $page->seo_title ?? $page->title,
    'seoDescription' => $page->seo_description,
    'seoKeyWords' => $page->seo_text_keys,
//    'sidebar' => false,
    ])

@push('header-code')
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <script>
        function onSubmit(token) {
            document.getElementById("contact-form").submit();
        }
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="breadcrumbs mb-4">
                <a href="{{homeLink()}}">Home</a>
                <span class="mx-1">/</span>
                <a href="{{$page->link()}}">{{$page->title}}</a>
            </div>
        </div>
        <div class="col-12">
            @if ($message = Session::get('adm_form_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
        </div>
        <div class="col-lg-4">
            <div class="pr-0 pr-lg-4">
                <div class="content">{!! $page->short !!}
                    <div class="mt-5">
                        <p class="h3 mb-3 font-weight-normal">
                            <a class="text-dark" href="mailto:{{$cf['email'] ?? ''}}">
                                {{$cf['email'] ?? ''}}
                            </a>
                        </p>
                        <p class="mb-3">
                            <a class="text-dark" href="tel:{{$cf['phone'] ?? ''}}">{{$cf['phone'] ?? ''}}</a>
                        </p>
                        <p class="mb-2">{{$cf['address'] ?? ''}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mt-4 mt-lg-0">
            <form method="post" action="{{admFormAction($cf['form_hash'])}}" class="row" id="contact-form">
                @csrf
                <div class="col-md-6">
                    <input type="text" class="form-control mb-4" placeholder="Name" name="name" id="name" required>
                </div>
                <div class="col-md-6">
                    <input type="email" class="form-control mb-4" placeholder="Email" name="email" id="email" required>
                </div>
                <div class="col-12">
                    <input type="text" class="form-control mb-4" placeholder="Subject" name="subject" id="subject" required>
                </div>
                <div class="col-12">
                    <textarea name="message" id="message" class="form-control mb-4" placeholder="Type You Message Here" rows="5"></textarea>
                </div>
                <div class="col-12">

                    @if(!empty(env('RECAPTCHA_SITE_KEY')))
                        <input
                            class="g-recaptcha btn btn-outline-primary"
                            data-sitekey="{{env('RECAPTCHA_SITE_KEY')}}"
                            data-callback='onSubmit'
                            data-action='submit'
                            type="submit"
                            value="{{$cf['form_button_text'] ?? ''}}"
                        >
                    @else
                        <button type="submit" class="btn btn-primary">
                            {{$cf['form_button_text'] ?? ''}}
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <script>
        console.log(@json($cf));
        console.log(@json($page));
        console.log(@json($page->customFields()));
    </script>
@endsection
