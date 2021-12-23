export default function walletChoice()
{
    const modalMoralis = document.querySelector('#modal-moralis'),
          modalChild = document.querySelector('.wallet-choice');

    document.getElementById('connect-wallet')

        .addEventListener('click', () => {
            if (modalMoralis.classList.contains('hidden')) {
                modalMoralis.classList.remove('hidden');
                modalMoralis.classList.add('flex');
            } else {
                modalMoralis.classList.remove('flex');
                modalMoralis.classList.add('hidden');
            }
        });

    modalMoralis.addEventListener('click', (ev) => {
        ev.stopPropagation();
        modalMoralis.classList.remove('flex');
        modalMoralis.classList.add('hidden');
    });

    modalChild.addEventListener('click', (ev) => { ev.stopPropagation(); })
}
