<div class="p-2 flex items-center justify-center">
    <div class="inline-flex items-center bg-white leading-none text-pink-600 rounded-full p-2 shadow text-teal text-sm">
        <span
            class="inline-flex bg-pink-600 text-white rounded-full h-6 px-3 justify-center items-center">{{ auth()->user()->subscription->name }}</span>
        @if (auth()->user()->subscription_expires->isPast())
        <span class="inline-flex px-2">Your subscription expired!</span>
        @else
        <span class="inline-flex px-2">Thanks for your subscription! It will expire
            {{ auth()->user()->subscription_expires->diffForHumans() }}</span>
        @endif
    </div>
</div>
