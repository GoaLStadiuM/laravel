/* Moralis init code */
Moralis.start({ serverUrl: 'https://9iuhdje4owkr.usemoralis.com:2053/server', appId: 'DTD1H8BKuE2sSM34ppMhV5IlG0DYROpsJRHmnYKl' });

let user = Moralis.User.current(), provider = 'metamask';

/* Authentication code */
async function login() {
    if (user)
        return;

    user = await Moralis.authenticate({ provider: provider, signingMessage: 'Connect to GoaL StadiuM' })
        .then(function (user) {
            console.log(Moralis.Web3API.account.getTokenBalances());
        })
        .catch(function (error) { console.log(error); });
}

async function logOut() {
    await Moralis.User.logOut();
    console.log('logged out');
}

function metamask() {
    if (user)
        return;

    provider = 'metamask';
    login();
}
function walletconnect() {
    if (user)
        return;

    provider = 'walletconnect';
    login();
}

document.getElementById('btn-login-metamask').onclick = metamask;
document.getElementById('btn-login-walletconnect').onclick = walletconnect;
document.getElementById('btn-logout').onclick = logOut;
