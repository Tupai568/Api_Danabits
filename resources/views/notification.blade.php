@error('g-recaptcha-response')
    <div class="notification error" id="notification">
        <span>{{ $message }}</span>
    </div>  
@enderror


@if (session()->has('error'))
    <div class="notification error" id="notification">
        <span>{{ session("error") }}</span>
    </div>    
@endif


@if (session()->has('success'))
    <div class="notification success" id="notification">
        <span>{{ session("success") }}</span>
    </div>    
@endif