<!DOCTYPE html>
<html>
<head>
    <title>Mail from BMW Enthusiasts</title>
</head>
<body>

    <h1>Hi, {{ $user->name }}</h1>
    <p>We have been posted a new event, come and check it out please</p>
    <h2 > {{$event->title}}</h2>
    <p> <span class="fw-bold text-muted"> {{__('messages.location')}}: </span>{{$event->location}}</p>
    <p> <span class="fw-bold text-muted"> {{__('messages.date')}}: </span> {{date('jS M Y', strtotime($event->date))}}</p>
    <p> {{$event->description}}</p>

    <img src="{{asset('images/events/'.$event->image_path)}}" alt="*event image*" height="200">
    <p>Yours Sincerely, </p>
    <p>BMW Enthusiasts </p>
</body>
</html>
