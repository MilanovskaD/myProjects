<p>☔ Heads up! Rain is coming soon in <strong>{{ $city }}</strong>.</p>
<p>Check your umbrella 🌂</p>

<p style="font-size: 12px; color: #666; margin-top: 20px;">
    <a href="{{ $unsubscribeLink }}" style="color: #666; text-decoration: underline;">
        ✋ Unsubscribe from {{ $city }} alerts
    </a>
    |
    <a href="{{ route('settings') }}" style="color: #666; text-decoration: underline;">
        Manage all subscriptions
    </a>
</p>
