{{-- Карточка фильма--}}
<section class="movie">
    <div class="movie__info">
        <div class="movie__poster">
            <img class="movie__poster-image" alt={{$alt}} src={{$src}}>
        </div>
        <div class="movie__description">
            <h2 class="movie__title">{{$title}}</h2>
            <p class="movie__synopsis">{{$synopsis}}</p>
            <p class="movie__data">
                <span class="movie__data-duration">{{$duration}}</span>
                <span class="movie__data-origin">США</span>
            </p>
        </div>
    </div>

    <div class="movie-seances__hall">
        <h3 class="movie-seances__hall-title">Зал 1</h3>
        <ul class="movie-seances__list">
            <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">10:20</a></li>
            <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">14:10</a></li>
            <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">18:40</a></li>
            <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">22:00</a></li>
        </ul>
    </div>
    <div class="movie-seances__hall">
        <h3 class="movie-seances__hall-title">Зал 2</h3>
        <ul class="movie-seances__list">
            <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">11:15</a></li>
            <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">14:40</a></li>
            <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">16:00</a></li>
            <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">18:30</a></li>
            <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">21:00</a></li>
            <li class="movie-seances__time-block"><a class="movie-seances__time" href="hall.html">23:30</a></li>
        </ul>
    </div>
</section>
