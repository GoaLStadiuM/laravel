<x-app-layout>
    <div class="bg-farming">
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-4 py-12">
            <div class="text-center pb-12">
                <h1 class="font-bold text-3xl md:text-4xl lg:text-5xl text-white">
                    TRAINING STATUS
                </h1>
            </div>
            <div class="soccerball">
                @include('farming.partials.soccerball', [ 'id' => 0 ])
                @include('farming.partials.soccerball', [ 'id' => 1 ])
                @include('farming.partials.soccerball', [ 'id' => 2 ])
                @include('farming.partials.soccerball', [ 'id' => 3 ])
                @include('farming.partials.soccerball', [ 'id' => 4 ])
                @include('farming.partials.soccerball', [ 'id' => 5 ])
            </div>
            <aside class="sci-panel">
                <div class="stats">
                    <h3><img src="{{ asset('img/strong.png') }}" width="64" class="icon-farming"></img> {{ $player->strengh }} <img src="{{ asset('img/accuracy.png') }}" class="icon-farming" width="64"></img> {{ $player->accuracy }}</h3>
                </div>
                <section class="max-w-6xl mx-auto py-12 farming-btns">
                    <div class="text-center pb-11">
                        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-1">
                            <div class="mb-8 mx-auto">
                                <img class="object-center object-cover rounded-full h-36 w-36" src="{{ asset(str_replace('assets/', '', $player->character->img_url)) }}">
                            </div>
                            <h3 class="cdown">Time remaining</h3>
                            <h3 id="demo" class="cdown-clock"></h3>
                        </div>
                    </div>
                </section>
            </aside>
            <div class="max-w-6xl mx-auto pt-12 farming-btns text-center text-white">
                <p style="font-size:32px; margin-bottom: 15px;">GoaL: {{ number_format(Auth::user()->goal, 4, '.', '') }}</p>
                <a id="trainingButton" href="{{ route('claim', $training->id) }}" onclick="return confirm('Are you sure?')" class="claim">Stop Training</a>
            </div>
        </section>
    </div>
    <script>
        function changeColor(id, color = '#40c456') {
            document.getElementById(id).style.fill = color;
        }

        function tick(i = 0)
        {
            // Get today's date and time
            const now = new Date(),
                  nowUTC = Date.UTC(now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate(),
                                    now.getUTCHours(), now.getUTCMinutes(), now.getUTCSeconds()),

            // Find the distance between now and the count down date
            distance = endUTC - nowUTC;

            if (distance >= 0) {
                // Time calculations for hours, minutes and seconds
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
                      minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)),
                      seconds = Math.floor((distance % (1000 * 60)) / 1000),
                      svg = 5 - hours;

                // Display the result in the element with id="demo"
                document.getElementById('demo').textContent = hours + 'h ' + minutes + 'm ' + seconds + 's ';

                if (minutes % 6 === 0 && seconds === 59) {
                    changeColor('soccerball-' + svg + '-path-' + map[minutes]);
                    skip.push(map[minutes]);
                }

                else {
                    if (!skip.includes(previous))
                        changeColor('soccerball-' + svg + '-path-' + previous, '#ff0000');

                    previous = i;
                    changeColor('soccerball-' + svg + '-path-' + i);
                }

                if (minutes === 0 && seconds === 0)
                    skip = [];

                setTimeout(() => tick((i + 1) % 5), 1000);
            }

            // If the count down is finished, make some changes
            else {
                document.getElementById('demo').textContent = 'Training finished.';
                document.getElementById('trainingButton').textContent = 'Claim your rewards!';
            }
        }

        const arrayDateTime = '{{ $training->endTime }}'.split(' '),
              date = arrayDateTime[0].split('-'),
              time = arrayDateTime[1].split(':'),
              endUTC = Date.UTC(date[0], date[1]-1, date[2], time[0], time[1], time[2]),
              maxHours = {{ $maxHours }},
              timeNow = new Date(),
              timeUTC = Date.UTC(timeNow.getUTCFullYear(), timeNow.getUTCMonth(), timeNow.getUTCDate(),
                                 timeNow.getUTCHours(), timeNow.getUTCMinutes(), timeNow.getUTCSeconds()),
              dis = endUTC - timeUTC,
              hs = Math.floor((dis % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)),
              soccerBalls = hs < 1 ? 6 : 5 - hs,
              mins = Math.floor((dis % (1000 * 60 * 60)) / (1000 * 60)),
              map = {
                54: 9,
                48: 8,
                42: 7,
                36: 6,
                30: 5,
                24: 4,
                18: 3,
                12: 2,
                 6: 1,
                 0: 0
              };
        let skip = [], i = 0, previous = 5;

        if (hs < maxHours) {
            for (let i = 0; i < soccerBalls; i++) {
                for (let x = 0; x < 10; x++) {
                    changeColor('soccerball-' + i + '-path-' + x);
                }
            }

            if (hs > -1 && mins < 55) {
                let id = 'soccerball-' + (5-hs) + '-path-';
                changeColor(id + '9');
                skip.push(9);
                if (mins < 49) {
                    changeColor(id + '8');
                    skip.push(8);
                    if (mins < 43) {
                        changeColor(id + '7');
                        skip.push(7);
                        if (mins < 37) {
                            changeColor(id + '6');
                            skip.push(6);
                            if (mins < 31) {
                                changeColor(id + '5');
                                skip.push(5);
                                if (mins < 25) {
                                    changeColor(id + '4');
                                    skip.push(4);
                                    if (mins < 19) {
                                        changeColor(id + '3');
                                        skip.push(3);
                                        if (mins < 13) {
                                            changeColor(id + '2');
                                            skip.push(2);
                                            if (mins < 7) {
                                                changeColor(id + '1');
                                                skip.push(1);
                                                if (mins < 1) {
                                                    changeColor(id + '0');
                                                    skip.push(0);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        setTimeout(() => tick(), 100);
    </script>
</x-app-layout>
