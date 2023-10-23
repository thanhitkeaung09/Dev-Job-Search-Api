<x-mail::message>
  [<img src="{{$img}}">](http://google.com.au/)
  Dear {{ $user ? $user : 'Customer' }},

  Thank you for using our services. To complete your forget password process, please use the following
  One-Time Password (OTP) code.

  OTP Code: [{{ $otp->otp }}]

  ကုဒ်ကို အသုံးပြုပြီး password ချိန်းပါ

  Please enter it in the otp confirm form to verify your email address and activate
  your account.

  If you did not request this code, please ignore this email.

  Thank you for using our application.

  Best regards,
  {{ config('app.name') }}
</x-mail::message>