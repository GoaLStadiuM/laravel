/* Moralis init code */
Moralis.start({ serverUrl: 'https://nzcmuvh8i6vd.usemoralis.com:2053/server', appId: 'HUsP6xB3wTQTddinmpkkdW71UZ8x8fI0rJs8wOF4' });

const tokenAddress = '0xbf4013ca1d3d34873a3f02b5d169e593185b0204',
      goalBalance = document.getElementById('goal-balance');

let user = Moralis.User.current(), provider = 'metamask';

/* Authentication code */
async function login() {
    user = Moralis.User.current();
    if (!user) {
        user = await Moralis.authenticate({ provider: provider, signingMessage: 'Connect to GoaL StadiuM' })
            .then(function (user) {
                updateBalance();
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
async function updateBalance()
{
    await Moralis.Web3API.account.getTokenBalances({ chain: 'bsc' }).forEach(function(token) {
        if (token.token_address === tokenAddress)
        {
            goalBalance.textContent = Number.parseFloat(balance / parseInt('1'.padEnd(token.decimals + 1, '0'))).toFixed(4);
        }
    });
}

if (user)
    updateBalance();

document.getElementById('btn-login-metamask').onclick = metamask;
document.getElementById('btn-login-walletconnect').onclick = walletconnect;
document.getElementById('btn-logout').onclick = logOut;
