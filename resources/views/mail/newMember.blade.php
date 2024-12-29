<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<div>
    <div>A new account from your email address - {{$user->email}} - has registered on <a href="{{ url('') }}">SlopeFinder UK</a>.</div>
    <div>Your user id is {{$user->id}} which should be quoted in any further correspondence.</div>
</div>
</html>