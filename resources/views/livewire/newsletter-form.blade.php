<div>
<form 
    wire:submit="subscribe()"
    method="post" class="subscribe_form relative mail_part">
    <x-form-alerts></x-form-alerts>
    <input type="text" wire:model.live="email" name="email" id="newsletter-form-email"
        placeholder="Email Address" class="placeholder hide-on-focus"
        onfocus="this.placeholder = ''"
        onblur="this.placeholder = ' Email Address '">
        @error('email')
            <span class="text-danger ml-1">{{$message}}</span>
        @enderror
    <div class="form-icon">
        <button type="submit" name="submit" id="newsletter-submit"
            class="email_icon newsletter-submit button-contactForm bg-light-gray"><img
                src="/front/assets/img/logo/form-iocn.png" alt=""></button>
    </div>
    <div class="mt-10 info"></div>
</form>
</div>

