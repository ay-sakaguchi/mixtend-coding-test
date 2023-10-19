<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mixtend-Engineer-Recruitment-Test-Calendar</title>
    @vite(['resources/sass/app.scss'])
  </head>
  <body>
    <div class="mx-auto" style="width: 1097px;">
      <div class="my-5">
        <h1 style="font-size: 24px">カレンダーUI</h1>
      </div>
      <div class="d-flex">
        <div class="" style="width: 150px">
          <div class="p-2 border border-bottom-0" style="height: 80px"></div>
          @foreach($aryWorkingHours as $aryWorkingHour)
            <div id="{{$aryWorkingHour}}00" class="p-2 border border-bottom-0 text-center align-middle" style="font-size:20px;height: 54px">{{ $aryWorkingHour }}:00</div>
            <div id="{{$aryWorkingHour}}30" class="p-2 border border-top-0" style="height: 54px"></div>
          @endforeach
        </div>
        @foreach($aryDate as $date)
          <div class="" style="width: 301px">
          <div id="{{$date}}" class="p-2 border border-bottom-0 d-flex align-items-center justify-content-center" style="font-size:20px;height: 80px">{{$date}}</div>
            @foreach($aryWorkingHours as $aryWorkingHour)
              <div id="{{$date}}{{$aryWorkingHour}}00" class="p-2 border border-bottom-0" style="height: 54px"></div>
              <div id="{{$date}}{{$aryWorkingHour}}30" class="p-2 border border-top-0" style="height: 54px"></div>
            @endforeach
          </div>
        @endforeach

        
      </div>
    </div>
  <script>
    const objMeetings = @json($aryMeetings);
    objMeetings.forEach(meeting => {
      let element2 = document.createElement('div');
      element2.innerHTML = meeting.summary;
      document.body.appendChild(element2);
      element2.style.position = 'absolute';
      element2.style.height = '108px';
      element2.style.width = '301px';
      element2.style.paddingTop = '20px';
      element2.style.paddingLeft = '20px';
      element2.style.backgroundColor='#49B5A9';
      element2.style.color = '#fff';
      element2.style.fontSize = '24px';
      let element = document.getElementById(meeting.start);
      let positionValue = element.getBoundingClientRect();
      element2.style.top = (positionValue.y + window.pageYOffset) + 'px'
      element2.style.left = (positionValue.x + window.pageXOffset) + 'px'
    });
  </script>
  </body>
</html>