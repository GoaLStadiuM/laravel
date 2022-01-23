/* Moralis init code */
Moralis.start({ serverUrl: 'https://nzcmuvh8i6vd.usemoralis.com:2053/server', appId: 'HUsP6xB3wTQTddinmpkkdW71UZ8x8fI0rJs8wOF4' });

const tokenAddress = '0xbf4013ca1d3d34873a3f02b5d169e593185b0204',
      connectBtn = document.getElementById('connect-wallet'),
      metamaskBtn = document.getElementById('btn-login-metamask'),
      wcBtn = document.getElementById('btn-login-walletconnect'),
      goalBalance = document.getElementById('goal-balance'),
      logoutBtn = document.getElementById('btn-logout'),
      modalMoralis = document.querySelector('#modal-moralis'),
      modalChild = document.querySelector('.wallet-choice');

// tmp fix
logOut();

/* Authentication code */
async function login(provider = 'metamask')
{
    if (Moralis.User.current())
        return;

    await Moralis.authenticate({ provider: provider, signingMessage: 'Connect to GoaL StadiuM' })
        .then(function (user) {
            // logged in
            console.log('logged in');
            hideModal();
            showConnected();

            Moralis.enableWeb3({ provider: provider });
        })
        .catch(function (error) { console.log(error); });
}

const getBalance = async () =>
{
    const balances = await Moralis.Web3API.account.getTokenBalances({ chain: 'bsc' }),
          token = balances.find((token) => token.token_address === tokenAddress);

    if (token === undefined)
        return 0;

    return Number.parseFloat(token.balance / parseInt('1'.padEnd(parseInt(token.decimals) + 1, '0'))).toFixed(4);
};

function showModal()
{
    modalMoralis.classList.remove('hidden');
    modalMoralis.classList.add('flex');
}

function hideModal(ev = null)
{
    if (ev)
        ev.stopPropagation();

    modalMoralis.classList.remove('flex');
    modalMoralis.classList.add('hidden');
}

function showConnected()
{
    connectBtn.classList.remove('block');
    connectBtn.classList.add('hidden');
    logoutBtn.classList.remove('hidden');
    logoutBtn.classList.add('block');
    setBalanceToCurrent();
}

function showDisconnected()
{
    connectBtn.classList.remove('hidden');
    connectBtn.classList.add('block');
    logoutBtn.classList.remove('block');
    logoutBtn.classList.add('hidden');
    setBalanceToZero();
}

async function logOut()
{
    await Moralis.User.logOut();
    console.log('logged out');
    showDisconnected();
}

function setBalanceToZero()
{
    goalBalance.textContent = 0;
}
function setBalanceToCurrent()
{
    getBalance().then((balance) => { goalBalance.textContent = balance; }); // todo: rework this
}
/*
if (Moralis.User.current())
{
    showConnected();
}

else
{
    showDisconnected();
}*/

Moralis.onAccountsChanged(function(accounts)
{
    if (!Moralis.User.current())
        return;

    console.log('account changed');
    if (accounts.length === 0)
        showDisconnected();

    else
        setBalanceToCurrent();
});

connectBtn.addEventListener('click', () => showModal());
modalMoralis.addEventListener('click', (e) => hideModal(e));
modalChild.addEventListener('click', (e) => { e.stopPropagation(); })
metamaskBtn.addEventListener('click', () => login());
wcBtn.addEventListener('click', () => login('walletconnect'));
logoutBtn.addEventListener('click', () => logOut());
