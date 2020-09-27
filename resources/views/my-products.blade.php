<x-app-layout title="My Products">
    <x-subscription-status></x-subscription-status>
    <product-grid type="my" :is-subscribed="{{ json_encode(auth()->user()->isSubscribed()) }}"></product-grid>
</x-app-layout>
