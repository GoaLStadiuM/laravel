const divisions = document.getElementById('divisions'),
      divSpan = document.getElementById('division'),
      characters = document.getElementById('characters'),
      click2earn = document.getElementById('click2earn'),
      firstDiv = document.getElementById('first-division'),
      secondDiv = document.getElementById('second-division'),
      thirdDiv = document.getElementById('third-division'),
      backToDiv = document.getElementById('back-division'),
      backToMenu = document.getElementById('back-menu'),
      assetsUrl = 'https://static.goalstadium.com/img/character/',
      gameUrl = 'https://play.goalstadium.com/penalties/',
      charactersEndPoint = gameUrl + 'characterlist',
      fetchCharacters = async () => await (await fetch(charactersEndPoint)).json(),
      playEndPoint = gameUrl + 'play',
      fetchPlay = async () => await (await fetch(playEndPoint)).json(),
      kickEndPoint = gameUrl + 'kick/',
      fetchKick = async (character_id) => await (await fetch(kickEndPoint + character_id)).json(),
      rewardEndPoint = gameUrl + 'kick/reward/',
      fetchReward = async (character_id) => await (await fetch(rewardEndPoint + character_id)).json(),
      htmlData = { 1: '', 2: '', 3: '' },
      result = document.querySelector('input[name=result]'),
      score = document.querySelector('input[name=score]'),
      slickOptions = {
          dots: false,
          infinite: true,
          speed: 1000,
          autoplay: false,
          arrows: true,
          prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
          nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
          slidesToShow: 4,
          slidesToScroll: 1,
          responsive: [
              {
                  breakpoint: 1200,
                  settings: {
                      slidesToShow: 3,
                      slidesToScroll: 1,
                      infinite: true,
                  }
              },
              {
                  breakpoint: 992,
                  settings: {
                      slidesToShow: 2,
                      slidesToScroll: 1
                  }
              },
              {
                  breakpoint: 767,
                  settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1,
                      arrows: false,
                  }
              },
              {
                  breakpoint: 575,
                  settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1,
                      arrows: false,
                  }
              },
          ]
      };

let data = false, playStatus = null, kick = null, reward = null;

async function loadData()
{ // todo: handle network errors
    await fetchCharacters().then(res => {

        res.characters.forEach(character => {

            htmlData[character.division] += `<div class="col-xl-2">
    <div class="shop-item">
        <div class="product-thumb">
            <img src="${assetsUrl + character.model_id + '.webp'}" alt="goal stadium character">
        </div>
        <div class="product-content">
            <div class="product-tag"><a>${character.character_name ?? character.base_name}</a></div>
            <h4>Character Stats</h4>
            <div class="product-meta2">
                <p>STRENGHT: <span>${character.strength}</span></p>
                <p>ACCURACY: <span>${character.accuracy}</span></p>
                <p>SCORE CHANCE: <span>${parseFloat(character.percentage).toFixed(3)}%</span></p>
                <h4>LEVEL ${character.level}</h4>
                <button onclick="play(${character.character_id})" class="btn rotated-btn">Play</button>
            </div>
        </div>
    </div>
</div>
`;
        });

        data = true;
    });
}

async function showCharacters(division)
{
    if (!data)
        await loadData();

    divSpan.textContent = division;
    characters.querySelector('div.product-active').innerHTML = htmlData[division];
    //$('.product-active').slick(slickOptions);
    hideElement(divisions);
    showElement(characters);
}

async function play(character_id)
{ // todo: handle network errors
    if (!playStatus)
        await fetchPlay().then(playResult => playStatus = playResult.play);

    if (!playStatus.is_it_time_to_kick)
    {
        alert("It's not the time yet.");
        window.location.replace('/penalties');
        return;
    }

    if (playStatus.kicks_left[character_id] === 0)
    {
        alert('No kicks left.');
        return;
    }

    await fetchKick(character_id).then(res => kick = res.kick);

    hideElement(characters);
    click2earn.dataset.id = character_id;
    showElement(click2earn);
}

async function click(iclick2earn)
{
    if (kick === null || iclick2earn.dataset.id === null)
        return;

    const id = iclick2earn.dataset.id;
    // todo: handle network errors
    reward = await fetchReward(id);

    result.value = kick ? 'GOAL!!! GG!!!' : 'Fuck me! FML!';
    score.value = kick ? reward.reward + ' GLS' : 'better luck next time...';

    playStatus.kicks_left[id] -= 1;

    const kicksLeft = playStatus.kicks_left[id],
          text = result.value + '\n' + score.value + '\n';

    if (kicksLeft > 0)
    {
        const plural = kicksLeft === 1 ? 'try' : 'tries',
              choice = confirm(text + 'You have ' + kicksLeft + plural + ' left\nDo you want to keep playing?');

        if (choice)
        {
            kick = null;
            click2earn.dataset.id = null;
            result.value = 'resetting, please wait...';
            score.value = 'resetting, please wait...';
            playStatus = null;
            await play(id, true);
            result.value = '';
            score.value = '';
        }

        else
        {
            window.location.replace('/penalties');
        }
    }

    else
    {
        alert(text + 'Thank you for playing.');
        window.location.replace('/penalties');
    }
}

function showDivisions()
{
    hideElement(characters);
    showElement(divisions);
}

function hideElement(el) {
    el.classList.remove('block');
    el.classList.add('none');
}

function showElement(el) {
    el.classList.remove('none');
    el.classList.add('block');
}

hideElement(characters);
hideElement(click2earn);

backToMenu.addEventListener('click', () => window.location.replace('/penalties'));
backToDiv.addEventListener('click', () => showDivisions());
firstDiv.addEventListener('click', () => showCharacters(1));
secondDiv.addEventListener('click', () => showCharacters(2));
thirdDiv.addEventListener('click', () => showCharacters(3));
click2earn.addEventListener('click', (e) => click(e.currentTarget));
