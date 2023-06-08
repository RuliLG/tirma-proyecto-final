<x-app-layout>
    <div class="my-slider">
        <div class="h-[400px] overflow-hidden relative">
            <img class="absolute h-full w-full inset-0 object-cover" src="https://images.unsplash.com/photo-1686019539035-d034ab44a075?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=3432&q=80">
        </div>
        <div class="h-[400px] overflow-hidden relative">
            <img class="absolute h-full w-full inset-0 object-cover" src="https://images.unsplash.com/photo-1636150721221-b88b3c2299be?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=3432&q=80" alt="">
        </div>
        <div class="h-[400px] overflow-hidden relative">
            <img class="absolute h-full w-full inset-0 object-cover" src="https://images.unsplash.com/photo-1632516643720-e7f5d7d6ecc9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1011&q=80" alt="">
        </div>
    </div>

    @push('scripts')
    <script>
        var slider = tns({
            container: '.my-slider',
            items: 2,
            slideBy: 1,
            autoplay: false
        });
    </script>
    @endpush
</x-app-layout>
