<!-- # JS Plugins -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/bootstrap.min.js')}}"></script>

<!-- Main Script -->
<script src="{{asset('assets/js/script.js')}}"></script>

<script src="{{asset('assets/plugins/lightbox2/dist/js/lightbox.min.js')}}"></script>
<script>
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
    })
</script>

@stack('footer-code')

{!! $site['customFooterCode'] !!}
