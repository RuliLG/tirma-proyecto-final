<x-app-layout>
    <x-nav title="Cotizaciones" />
    <x-breadcrumb />
    <div class="p-8">
        <livewire:base-report />
    </div>


    <div class="h-[400px]">
        <livewire:livewire-column-chart
        :column-chart-model="$columnChartModel"
        />
    </div>
</x-app-layout>
