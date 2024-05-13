@component('mail::message')
    <h1>Welcome to Gym Bilog, {{ $name }}!</h1>
    <p class="text-center">Welcome to Gym Bilog! We're excited to have you join our fitness community.<br> Our mission is to
        support you in achieving your fitness goals through personalized workout plans and a motivating environment. </p>
    <div class="img_wrap">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $client_id }}" alt="">
    </div>
    @component('mail::button', ['url' => ''])
        Explore Gym Bilog
    @endcomponent
    <p>Thanks, {{ config('app.name') }}</p>
@endcomponent
