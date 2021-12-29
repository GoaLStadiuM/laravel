import swiperResponsive from './modules/swiper-responsive.js';
swiperResponsive();

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
      products = document.querySelectorAll('.card-goal'),
      prices = document.querySelectorAll('[id ^= "division"]'),
      modalCarrousel = document.querySelector('#modal-carrousel'),
      promptCard = document.querySelector('#prompt-card'),
      closeModal = document.querySelector('#close-carrousel'),
      myToken = 'https://api.pancakeswap.info/api/v2/tokens/' + tokenAddress,
      shopWallet = '0x4e68EBbB3cf4e107315996a960e2437301563859',
      postUrl = 'https://play.goalstadium.com/penalties/shop/purchase',
      swiperOptions = {
          effect: 'cards',
          loop: true,
          allowTouchMove: false,
          autoplay: 1,
          speed: 100,
      },
      swiperClass = '.mySwiper',
      //Radnomtime carrousel
      randomTime = Math.floor(Math.random() * (15000 - 8000)) + 8000,
      svgX = `<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
</svg>`,
      svgMenu = `<svg
xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewbox="0 0 24 24"
stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
</svg>`,

      fetchToken = async () => { return await (await fetch(myToken)).json(); },

      wait = (delay) => new Promise((resolve) => setTimeout(resolve, delay)),

      postPurchase = (url, options, retries = 0, delay = 0) =>

        fetch(url, options)
            .then(res => {
                if (res.ok)
                    return res.json();

                if (retries > 0)
                    return wait(delay).then(() => postPurchase(url, options, retries - 1, delay));

                throw new Error(res.status);
            })
            .catch(error => {
                console.error(error.message);

                if (retries > 0)
                    return wait(delay).then(() => postPurchase(url, options, retries - 1, delay));

                throw new Error(error.message);
            });

    let swiper = null;

updatePrices();

// product prices
async function updatePrices()
{
    const goal = (await fetchToken()).data;

    Array.prototype.forEach.call(prices, function(el, it)
    {
        el.textContent = Number.parseFloat(el.dataset.price / goal.price).toFixed(2) + ' ' + goal.symbol;
    });

    setTimeout(() => updatePrices(), 60000);
}

function showError(error)
{
    alert(error);
    hideCarrousel();
}

function f_fixDecimalPlace( _value, _decimals)
{
    return Function( '"use strict";return (' + _value / 10 ** _decimals + ')' )();
}

async function purchase(product)
{
    if (!Moralis.User.current())
        return;

    modalCarrousel.classList.remove('hidden');
    modalCarrousel.classList.add('flex');

    // todo show waiting animation

    const goal = (await fetchToken()).data,
          decimals = (await Moralis.Web3API.token.getTokenMetadata({ chain: 'bsc', addresses: tokenAddress }))[0].decimals,
          product_price = product.lastElementChild,
          amount = Number.parseFloat(product_price.dataset.price / goal.price).toFixed(2),
          goalInWei = Moralis.Units.Token('123.456', '7');
console.log(goalInWei)
    let transferResult = await Moralis.transfer({
        type: 'erc20',
        amount: goalInWei,
        receiver: shopWallet,
        contractAddress: tokenAddress
    })

        .catch(() => hideCarrousel());

    if (!transferResult?.status)
        return showError('Purchase failed.');

    let postResult = await postPurchase(postUrl, {
        method: 'post',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: product_price.dataset.productId,
            tx_hash: transferResult.transactionHash
        })
    }, 10, 3000);

    if (!postResult.ok)
        return showError('Network error. Please, contact support with your tx hash.');

    swiper = new Swiper(swiperClass, swiperOptions);
    swiper.autoplay.start();

    setTimeout(() => showCharacter(postResult.characterIndex), randomTime);
}

/*
 * swiper
 */

const showCharacter = (characterIndex) => {

    swiper.autoplay.stop();
    swiper.slideToLoop(characterIndex, 1, false);

    const img = document.createElement('img'),
          span = document.createElement('span'),
          card = document.querySelector('[data-index="' + characterIndex + '"]');

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
        promptCard.classList.remove(
            'flex',
            'animate__animated',
            'animate__fadeInDown',
            'animate__faster'
        );
        promptCard.classList.add('hidden');
        promptCard.replaceChildren();
    }, 5000);

    modalCarrousel.addEventListener('click', hideCarrousel);
};

function hideCarrousel(event = null)
{
    if (event)
    {
        event.stopPropagation();
        modalCarrousel.removeEventListener('click', hideCarrousel);
        closeModal.classList.remove('cursor-pointer');
        closeModal.classList.add('cursor-not-allowed');
        swiper.slideToLoop(0, 1, false);
        swiper = null;
    }

    modalCarrousel.classList.remove('flex');
    modalCarrousel.classList.add('hidden');
}

/*
 * shop ux
 */

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

menuResponsive.addEventListener('click', (e) => {
    e.stopPropagation();
    menuResponsive.classList.add('hidden');
    btnMenu.innerHTML = svgMenu;
});

btnLFirst.addEventListener('click', () => { firstDiv.scrollLeft -= 152; });
btnRFirst.addEventListener('click', () => { firstDiv.scrollLeft += 152; });

btnLSecond.addEventListener('click', () => { secondDiv.scrollLeft -= 152; });
btnRSecond.addEventListener('click', () => { secondDiv.scrollLeft += 152; });

btnLThird.addEventListener('click', () => { thirdDiv.scrollLeft -= 152; });
btnRThird.addEventListener('click', () => { thirdDiv.scrollLeft += 152; });

products.forEach((card) => { card.addEventListener('click', (e) => { purchase(e.currentTarget); }); });
