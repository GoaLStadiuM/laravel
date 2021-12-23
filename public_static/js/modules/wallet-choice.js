export default function walletChoice() {
    //querySelectors
    const modalMoralis = document.querySelector('#modal-moralis');

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
        window.location.reload();
    });
}
