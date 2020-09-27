<x-app-layout title="Products">
    <product-grid :is-subscribed="{{ json_encode(auth()->user()->isSubscribed()) }}"></product-grid>
</x-app-layout>
