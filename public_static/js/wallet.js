/* Moralis init code */
Moralis.start({ serverUrl: 'https://9iuhdje4owkr.usemoralis.com:2053/server', appId: 'DTD1H8BKuE2sSM34ppMhV5IlG0DYROpsJRHmnYKl' });

let user = Moralis.User.current(), provider = 'metamask';

/* Authentication code */
async function login() {
    if (!user) {
      user = await Moralis.authenticate({ provider: provider, signingMessage: 'Connect to GoaL StadiuM' })
        .then(function (user) {
            balance();
        })
        .catch(function (error) { console.log(error); });
    }
}

async function logOut() {
  await Moralis.User.logOut();
  console.log('logged out');
}

function metamask() {
  login();
}
function walletconnect() {
  provider = 'walletconnect';
  login();
}

document.getElementById('btn-login-metamask').onclick = metamask;
document.getElementById('btn-login-walletconnect').onclick = walletconnect;
document.getElementById('btn-logout').onclick = logOut;

async function balance()
{
    if (user)
    {
        const balances = await Moralis.Web3API.account.getTokenBalances();
        console.log(balances);
    }
}

balance();
