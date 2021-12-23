/* Moralis init code */
Moralis.start({ serverUrl: 'https://nzcmuvh8i6vd.usemoralis.com:2053/server', appId: 'HUsP6xB3wTQTddinmpkkdW71UZ8x8fI0rJs8wOF4' });

const tokenAddress = '0xbf4013ca1d3d34873a3f02b5d169e593185b0204',
      connectBtn = document.getElementById('connect-wallet'),
      metamaskBtn = document.getElementById('btn-login-metamask'),
      wcBtn = document.getElementById('btn-login-walletconnect'),
      logoutBtn = document.getElementById('btn-logout');

/* Authentication code */
async function login(provider = 'metamask')
{
    if (Moralis.User.current())
        return;
console.log('authenticating...')
    await Moralis.authenticate({ provider: provider, signingMessage: 'Connect to GoaL StadiuM' })
        .then(function (user) {
            // logged in
            console.log('logged in');
            showConnected();
        })
        .catch(function (error) { console.log(error); });
}

async function getBalance()
{
    const balances = await Moralis.Web3API.account.getTokenBalances({ chain: 'bsc' });

    balances.forEach(function(token) {
        if (token.token_address === tokenAddress)
        {
            return Number.parseFloat(token.balance / parseInt('1'.padEnd(parseInt(token.decimals) + 1, '0'))).toFixed(4);
        }
    });
}

function showConnected()
{
    connectBtn.classList.remove('block');
    connectBtn.classList.add('hidden');
    logoutBtn.classList.remove('hidden');
    logoutBtn.classList.add('block');
}

function showDisconnected()
{
    connectBtn.classList.remove('hidden');
    connectBtn.classList.add('block');
    logoutBtn.classList.remove('block');
    logoutBtn.classList.add('hidden');
}

async function logOut() {
    await Moralis.User.logOut();
    console.log('logged out');
    showDisconnected();
}

metamaskBtn.addEventListener('click', () => login());
wcBtn.addEventListener('click', () => login('walletconnect'));
logoutBtn.addEventListener('click', () => logOut());
