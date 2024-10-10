<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Feed</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    @foreach($feeds as $feed)
    @foreach($feed['items'] as $item)
    <div class="feed-item"> 
        <video autoplay loop muted>
            <source src="{{ asset('videos/earth.mp4') }}" type="video/mp4">
        </video>
   
        <div class="time-box">
            <div class="channel">
                @if($feed['channelLogo'])
                    <span class="logo">
                        <img src="{{ $feed['channelLogo'] }}" alt="">
                    </span>
                @endif
                <span class="name">{{ $feed['channelName'] }}</span>
            </div>
            <div class="time">{{ $item['pubDate'] }}</div>
        </div>

        <div class="slider">
            <div class="loader-bar"></div>
        </div>

        <div class="main">
            <div class="main-item">
                <div class="image">
                     @if($item['image'])
                     <img src="{{ $item['image'] }}" alt="RSS image" >
                     @else
                     <img src="{{ asset('images/default.avif') }}" alt="Default image">
                     @endif
                </div>
                <div class="content">
                     <h1>{{$item['title'] }}</h1>
                     <p>{{ $item['description'] }}</p>
                </div>   
            </div>
        </div>
       
       
    
    </div> 
    @endforeach
    @endforeach
    
    <script>
        window.onload = function() {
        let currentIndex = 0;
        const items = document.querySelectorAll('.feed-item');
        const totalItems = items.length;

        function showItem(index) {
            items.forEach((item, i) => {
                item.style.display = (i === index) ? 'block' : 'none';
            });

           
            const mainItem = items[index].querySelector('.main-item');
            const mainDiv = items[index].querySelector('.main');

            mainDiv.classList.add('bg-slide');

            setTimeout(() => {
                mainItem.style.opacity = 1; 
            }, 3000);

        }

        showItem(currentIndex);

        setInterval(() => {
            const mainItem = items[currentIndex].querySelector('.main-item');
            mainItem.style.opacity = 0; 
            currentIndex = (currentIndex + 1) % totalItems; 
            showItem(currentIndex);
           
        }, 15000); 
    };
    </script>

</body>
</html>
