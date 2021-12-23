import walletChoice from './modules/wallet-choice.js';
import swiperResponsive from './modules/swiper-responsive.js';

window.addEventListener('DOMContentLoaded', () => {
    walletChoice();
    swiperResponsive();
});

const menuResponsive = document.querySelector('#bg-menu-responsive'),
      sidebarResponsive = document.querySelector('#sidebar-responsive'),
      btnMenu = document.querySelector('#btn-menu'),
      btnLFirst = document.querySelector('#btn-l-first'),
      btnRFirst = document.querySelector('#btn-r-first'),
      btnLSecond = document.querySelector('#btn-l-second'),
      btnRSecond = document.querySelector('#btn-r-second'),
      btnLThird = document.querySelector('#btn-l-third'),
      btnRThird = document.querySelector('#btn-r-third'),
      firstDiv = document.querySelector('#first-division'),
      secondDiv = document.querySelector('#second-division'),
      thirdDiv = document.querySelector('#third-division'),
      prices = document.querySelectorAll('[id ^= "division"]'),
      contractAddress = '0xbf4013ca1d3d34873a3f02b5d169e593185b0204',
      myToken = 'https://api.pancakeswap.info/api/v2/tokens/' + contractAddress,
      shopWallet = '0x695BB7828F8FF8804F593F6DE63c474DDfAD6c3D',
      modalCarrousel = document.querySelector("#modal-carrousel"),
      cardCarousel = document.querySelectorAll(".swiper-slide"),
      promptCard = document.querySelector("#prompt-card"),
      closeModal = document.querySelector("#close-modal"),
      //Initializing swiper
      swiper = new Swiper(".mySwiper", {
          effect: "cards",
          loop: true,
          allowTouchMove: false,
          autoplay: 1,
          speed: 100,
      }),
      //Radnomtime carrousel
      randomTime = Math.floor(Math.random() * (15000 - 8000)) + 8000,
      svgX = `<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
</svg>`,
      svgMenu = `<svg
xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewbox="0 0 24 24"
stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
</svg>`;

let tries = 0, maxTries = 9, goal = null, goal_decimals = null, response = null;

//Events

btnMenu.addEventListener('click', () => {
    if (menuResponsive.classList.contains('hidden')) {
        menuResponsive.classList.remove('hidden');
        btnMenu.innerHTML = svgX;
        sidebarResponsive.classList.add(
            'animate__animated',
            'animate__fadeInLeft',
            'animate__faster'
        );
    } else {
        menuResponsive.classList.add('hidden');
        btnMenu.innerHTML = svgMenu;
    }
});

menuResponsive.addEventListener('click', (ev) => {
    ev.stopPropagation();
    menuResponsive.classList.add('hidden');
    btnMenu.innerHTML = svgMenu;
});

btnLFirst.addEventListener('click', () => { firstDiv.scrollLeft -= 152; });
btnRFirst.addEventListener('click', () => { firstDiv.scrollLeft += 152; });

btnLSecond.addEventListener('click', () => { secondDiv.scrollLeft -= 152; });
btnRSecond.addEventListener('click', () => { secondDiv.scrollLeft += 152; });

btnLThird.addEventListener('click', () => { thirdDiv.scrollLeft -= 152; });
btnRThird.addEventListener('click', () => { thirdDiv.scrollLeft += 152; });

const fetchPrice = async () => {
    response = await fetch(myToken);
    return await response.json();
}
async function getPrice()
{
    return await response.json();
}
async function updatePrices()
{
    goal = (await fetchPrice()).data;

    Array.prototype.forEach.call(prices, function(el, it)
    {
        el.textContent = Number.parseFloat(el.dataset.price / goal.price).toFixed(4) + ' ' + goal.symbol;
    });

    setTimeout(() => updatePrices(), 60000);
}
function error(err)
{
    if (tries < maxTries)
    {
        console.log('network error, retrying...');
        updatePrices();
    }

    else
    {
        alert('network error, please contact support.');
    }

    tries += 1;
}
updatePrices();

async function updateBalance()
{
    const balances = await Moralis.Web3API.account.getTokenBalances({ chain: 'bsc' });

    balances.forEach(function(token) {
        if (token.token_address === tokenAddress)
        {
            goal_decimals = token.decimals;
            goalBalance.textContent = Number.parseFloat(token.balance / parseInt('1'.padEnd(parseInt(token.decimals) + 1, '0'))).toFixed(4);
        }
    });
}

if (user)
{
    updateBalance();
}

else
{

}

document.querySelectorAll('.card-goal').forEach((card) => {
    card.addEventListener('click', async (ev) => {

        const card = ev.target;
        goal = (await fetchPrice()).data;
console.log(card.dataset.price);
console.log(goal.price);
console.log(card.dataset.price / goal.price);
console.log(goal_decimals);
        const options = {
            type: 'erc20',
            amount: Moralis.Units.Token(Number.parseFloat(card.dataset.price / goal.price).toFixed(goal_decimals), goal_decimals),
            receiver: shopWallet,
            contractAddress: tokenAddress
        }
        let result = await Moralis.transfer(options);
        console.log(result);

/*
        swiper.autoplay.start();

        if (modalCarrousel.classList.contains('hidden')) {
            modalCarrousel.classList.remove('hidden');
            modalCarrousel.classList.add('flex');
            //Modal carrousel animation
            setTimeout(modal, randomTime);
        } else {
            modalCarrousel.classList.remove('flex');
            modalCarrousel.classList.add('hidden');
        }*/
    });
});

const modal = () => {
    swiper.autoplay.stop();
    modalCarrousel.addEventListener('click', (ev) => {
        ev.stopPropagation();
        modalCarrousel.classList.remove('flex');
        modalCarrousel.classList.add('hidden');
        window.location.reload();
    });
    //Get card info
    cardCarousel.forEach((card) => {
        const swiperIndex = swiper.realIndex;
        const cardIndex = card.dataset.index;
        if (swiperIndex === Number(cardIndex)) {
            //Creating prompt card
            const img = document.createElement('img');
            const span = document.createElement('span');

            img.src = card.src;
            img.alt = card.alt;
            img.classList.add(
                'w-full',
                'h-full',
                'object-cover',
                'rounded-t-md'
            );

            span.innerText = 'Added to your team';
            span.classList.add('text-center', 'text-slate-800', 'my-2');
            promptCard.appendChild(img);
            promptCard.appendChild(span);
            promptCard.classList.remove('hidden');
            promptCard.classList.add(
                'flex',
                'animate__animated',
                'animate__fadeInDown',
                'animate__faster'
            );
            closeModal.classList.remove('cursor-not-allowed');
            closeModal.classList.add('cursor-pointer');
            setTimeout(() => {
                promptCard.classList.remove('flex');
                promptCard.classList.add('hidden');
            }, 5000);
        }
    });
};
