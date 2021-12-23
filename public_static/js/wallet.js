/* Moralis init code */
Moralis.start({ serverUrl: 'https://9iuhdje4owkr.usemoralis.com:2053/server', appId: 'DTD1H8BKuE2sSM34ppMhV5IlG0DYROpsJRHmnYKl' });

const tokenAddress = '0xbf4013ca1d3d34873a3f02b5d169e593185b0204',
      goalBalance = document.getElementById('goal-balance');

let user = null, provider = 'metamask';

/* Authentication code */
async function login() {
    user = Moralis.User.current();
    if (!user) {
        user = await Moralis.authenticate({ provider: provider, signingMessage: 'Connect to GoaL StadiuM' })
            .then(function (user) {
                Moralis.Web3API.account.getTokenBalances({ chain: 'bsc' }).forEach(function(token) {
                    if (token.token_address === tokenAddress)
                    {
                        goalBalance.textContent = Number.parseFloat(balance / parseInt('1'.padEnd(token.decimals + 1, '0'))).toFixed(4);
                    }
                });
            })
            .catch(function (error) { console.log(error); });
    }
}

async function logOut() {
    await Moralis.User.logOut();
    console.log('logged out');
}

function metamask() {
    provider = 'metamask';
    login();
}
function walletconnect() {
    provider = 'walletconnect';
    login();
}

document.getElementById('btn-login-metamask').onclick = metamask;
document.getElementById('btn-login-walletconnect').onclick = walletconnect;
document.getElementById('btn-logout').onclick = logOut;
