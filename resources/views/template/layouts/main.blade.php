<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@includeIf('template.parts.header.head-scripts')

<body>

@includeIf('template.parts.header.header')

<main>
    <section class="section">
        <div class="container">
            @if(!empty($sidebar))
            <div class="row no-gutters-lg">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    @yield('content')
                </div>
                <div class="col-lg-4">
                    @includeIf('template.parts.sidebar.sidebar')
                </div>
            </div>
            @endif

            @empty($sidebar)
                <div class="row no-gutters-lg">
                    @yield('content')
                </div>
            @endempty
        </div>
    </section>
</main>

@includeIf('template.parts.footer.footer')

@includeIf('template.parts.footer.footer-scripts')

<x-adm-top-bar/>

</body>
</html>

