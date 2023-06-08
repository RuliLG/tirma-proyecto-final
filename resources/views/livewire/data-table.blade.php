<div>
    <button type="button" wire:click="exportToExcel">Download as Excel</button>
    <button type="button" wire:click="exportToPdf">Download as PDF</button>
    <button type="button" wire:click="sendOverEmail">Send Excel</button>
    {{ $this->table }}
</div>

@once
    @push('scripts')
    <script>
        window.addEventListener('keydown', function (e) {
            if (e.keyCode === 69 && e.metaKey || e.keyCode === 69 && e.controlKey) {
                @this.exportToExcel()
            }
        });
    </script>
    @endpush
@endonce
