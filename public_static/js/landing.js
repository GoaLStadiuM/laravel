// landing videos

const video =
{
    url: '',
    //background: true,
    //autopause: true,
    responsive: true,
    autoplay: true,
    loop: true
};

video.url = 'https://player.vimeo.com/video/642664731?h=0da8240066';
new Vimeo.Player('goal_video', video);
//new Vimeo.Player('training_video', video);
//video.url = 'https://player.vimeo.com/video/642662417?h=b611e3141e';
//new Vimeo.Player('resting_video', video);
//video.url = 'https://player.vimeo.com/video/642664994?h=e1a69e89e6';

// player-scroll-animation
/*
gsap.registerPlugin(ScrollTrigger);

gsap.to('.goal-keeper-avatar', {
  y: -150,
  duration: 1,
  scrollTrigger: {
    trigger: '.goal-keeper-avatar',
    ease: 'power3',
    start: 'top 80%',
    end: 'top 40%',
    toggleActions: 'restart none none none',
    // markers:true,
  },
});
gsap.to('.ball', {
  x: 341,
  duration: 1,
  scrollTrigger: {
    trigger: '.ball',
    ease: 'power3',
    start: 'top 80%',
    end: 'top 40%',
    toggleActions: 'restart none none none',
    // markers:true,
  },
});

const el = document.getElementById('ball-translation');
//el.addEventListener('animationstart', listener, false);
//el.addEventListener('animationend', listener, false);

el.className = 'transition';

function listener(e)
{
    switch(e.type) {
        case 'animationstart':
        console.log('start');
          break;
        case 'animationend':
          console.log('end');
          break;
    }
}*/

// character cards swiper

var swiper = new Swiper('.mySwiper', {
    effect: 'cards',
    grabCursor: true
});

window.onload = function() { document.getElementById('benja').play(); };

swiper.on('slideChange', function()
{
    document.getElementById('benja').pause();
    document.getElementById('crisnaldo').pause();
    document.getElementById('peque').pause();
    document.getElementById('warrer').pause();
    document.getElementById('sinedine').pause();
    document.getElementById('hypsola').pause();

    switch(swiper.activeIndex)
    {
        case 0:
        document.getElementById('benja').play();
        document.getElementById('card-name').textContent = 'Benja';
        break;
        case 1:
        document.getElementById('crisnaldo').play();
        document.getElementById('card-name').textContent = 'Crisnaldo';
        break;
        case 2:
        document.getElementById('peque').play();
        document.getElementById('card-name').textContent = 'Peque';
        break;
        case 3:
        document.getElementById('warrer').play();
        document.getElementById('card-name').textContent = 'Red Warrer';
        break;
        case 4:
        document.getElementById('sinedine').play();
        document.getElementById('card-name').textContent = 'Sinedine Sedini';
        break;
        case 5:
        document.getElementById('hypsola').play();
        document.getElementById('card-name').textContent = 'Hypsola';
        break;
    }
});
