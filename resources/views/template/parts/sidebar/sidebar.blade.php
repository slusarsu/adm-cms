<div class="widget-blocks">
    <div class="row">

        <div class="col-lg-12">
            <x-about-me/>
        </div>
        <div class="col-lg-12 col-md-6">
            <x-chunk-position :position="'sidebar'"/>
            @includeIf('template.parts.sidebar.popular-posts')
        </div>
        <div class="col-lg-12 col-md-6">
            @includeIf('template.parts.sidebar.categories')
        </div>
        <div class="col-lg-12 col-md-6">
            @includeIf('template.parts.sidebar.tags')
        </div>
    </div>
</div>
