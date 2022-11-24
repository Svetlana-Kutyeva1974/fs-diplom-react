
                @php
                   $string = 'зал: '.$hall['nameHall'].', фильм: '.$film['title'].', начало сеанса: '.substr($seance['startSeance'], -8, 5);
                @endphp
                @foreach (json_decode($selected) as $item)
                    @php
                        //Подготовка строки кодировки

                        $int = (int)$hall['col'];
                        $string .= ", ряд ".explode(',',$item)[0]." место". (explode(',',$item)[1]+(explode(',',$item)[0]-1)*$int);
                        //Формирование кода qr
                        //require_once 'C:\0-Web-учеба\0-блок12-lavarel\fs-diplom-react\phpqrcode\qrlib.php';
                        //echo base_path() . '\phpqrcode\qrlib.php';
                        require_once base_path() . '\phpqrcode\qrlib.php';
                        //QRcode::png($string, 'C:\0-Web-учеба\0-блок12-lavarel\fs-diplom-react\public\i\qr.png', 'H', 48, 2);
                        QRcode::png($string, base_path() . '\public\i\qr.png', 'H', 48, 2);
                    @endphp
                @endforeach
                function arr2(event){
                let url = "{{route('client.seat', ['hall'=> $hall, 'seance'=> $seance, 'film'=> $film, 'dateChosen'=> $dateChosen, 'seats'=> $seats->where('hall_id', $hall['id'])->where('seance_id', $seance['id']), 'selected' => 'json'])}}";

                //console.log('url   ',url);console.log('selected url  ', selected);

                url = url.replace('json', json);//console.log('replace url  ', url);
                url = url.replaceAll('&amp;', '&');//console.log('replace amp url  ', url);
                window.location.href = url;
                }
