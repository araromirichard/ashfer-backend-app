@component('mail::message')
# Introduction

Thanks for contacting us.

@component('mail::button', ['url' => 'https://ashfargroup.com/blog'])
visit our Blog
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent