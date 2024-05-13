
--Account Login Notification--
<br>
Hello {{ $name }},
<br>
We wanted to inform you that your account was logged in at the following date and time:
<br>
<br>
- **Date:** {{ $loginDate }}
- **Time:** {{ $loginTime }}
<br>
<br>
If you believe this login activity was not authorized by you,
<br> please [contact us immediately](mailto:SuperGymBilog@gmail.com).
<br>
Thank you.
<br>
<br>
Best regards,
{{config('app.name')}}
