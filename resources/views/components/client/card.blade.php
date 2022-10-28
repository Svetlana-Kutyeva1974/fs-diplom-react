{{-- Карточка фильма     {{ route('component.client.hall', ['halls' => $halls[0]])}}--}}

<section class="movie">
    <div class="movie__info">
        <div class="movie__poster">
            <img class="movie__poster-image" alt={{$film->imageText}} src={{$film->imagePath}}>
        </div>
        <div class="movie__description">
            <h2 class="movie__title">{{$film->title}}</h2>
            <p class="movie__synopsis">{{$film->description}}</p>
            <p class="movie__data">
                <span class="movie__data-duration">{{$film->duration}} минут</span>
                <span class="movie__data-origin">{{$film->origin}}</span>
            </p>
        </div>
    </div>

    @foreach ($halls as $hall)
        @if ($seances->where('hall_id', $hall->id)->where('film_id', $film->id)->count())
            {{--}}{{'xbtttttttttttttttttttttttttg'}}{{$hall->id}}
            {{$seances->where('hall_id', $hall->id)->where('film_id', $film->id)->count()}}--}}
    <div class="movie-seances__hall">
        <h3 class="movie-seances__hall-title">{{$hall->nameHall}}</h3>
        <ul class="movie-seances__list">
            @foreach ($seances as $item)
                @if($item->film_id === $film->id && $item->hall_id === $hall->id)
                    <li class="movie-seances__time-block"><a class="movie-seances__time" href="{{ route('hall', ['nameHall' => $hall->nameHall, 'seance'=> $item]) }}">{{substr($item->startSeance, -8,5)}}</a></li>
                @endif
            @endforeach
        </ul>
    </div>
        @endif
    @endforeach
</section>