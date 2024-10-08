<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Feed</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        .feed-item {
            display: none; 
        }

        @keyframes bg-slide {
            from {
                background-color: rgba(0, 0, 0, 0.5);
                transform: translateX(100%); 
            }
            to {
                background-color: rgba(0, 0, 0, 0);
                transform: translateX(0%); 
            }
        }

        .bg-slide {
            animation: bg-slide 4s ease; 
        }

        .main-item {
            opacity: 0; 
            transition: opacity 4s ease; 
        }
    </style>
</head>
<body>
   
    @foreach($feedItems as $item)
    <div class="feed-item"> 
        <video autoplay loop muted>
            <source src="{{ asset('videos/earth.mp4') }}" type="video/mp4">
        </video>
   
        <div class="time-box">
            <div>{{ $item['pubDate'] }}</div>
        </div>

        <div class="slider">
            <div class="loader-bar"></div>
        </div>

        <div class="main">
            <div class="main-item">
                <div class="image">
                     @if($item['image'])
                     <img src="{{ $item['image'] }}" alt="RSS image" >
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


    <script>
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
            }, 4000);

        }

        showItem(currentIndex);

        setInterval(() => {
            currentIndex = (currentIndex + 1) % totalItems; 
            showItem(currentIndex);
        }, 15000); 
    </script>

</body>
</html>
