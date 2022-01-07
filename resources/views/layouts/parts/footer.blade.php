<a href="#" class="back-to-top">
    <i class="bi bi-arrow-up"></i>
</a>

{{-- @guest
    @include("layouts.parts.footer_guest")
@else
    @include("layouts.parts.footer_min")
@endguest --}}

@include("layouts.parts.footer_min")

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<script src="{{ asset('js/main.js') }}"></script>

</body>
</html>