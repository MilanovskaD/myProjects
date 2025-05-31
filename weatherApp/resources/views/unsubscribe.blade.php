<div class="max-w-md mx-auto mt-10 p-6 bg-white/10 backdrop-blur-sm rounded-xl shadow-lg">
    @if($success ?? false)
        <h1 class="text-2xl font-semibold mb-4">✅ Unsubscribed</h1>
        <p>You won't receive more rain alerts for {{ $city }}.</p>
    @else
        <h1 class="text-2xl font-semibold mb-4">❌ Error</h1>
        <p>Invalid unsubscribe link. Please try again.</p>
    @endif

    <a href="{{ route('settings') }}"
       class="mt-4 inline-block bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
        Back to Settings
    </a>
</div>
