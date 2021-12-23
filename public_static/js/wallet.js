/* Moralis init code */
Moralis.start({ serverUrl: 'https://9iuhdje4owkr.usemoralis.com:2053/server', appId: 'DTD1H8BKuE2sSM34ppMhV5IlG0DYROpsJRHmnYKl' });

let user = null;

/* Authentication code */
async function login(provider = 'metamask') {console.log(provider)
  user = Moralis.User.current();
  if (!user) {
    user = await Moralis.authenticate({ provider: provider, signingMessage: 'Log in using Moralis' })
      .then(function (user) {
        console.log("logged in user:", user);
        console.log(user.get("ethAddress"));
      })
      .catch(function (error) {
        console.log(error);
      });
  }
}

async function logOut() {
  await Moralis.User.logOut();
  console.log('logged out');
}

document.getElementById('btn-login-metamask').onclick = login();
document.getElementById('btn-login-walletconnect').onclick = login('walletconnect');
document.getElementById('btn-logout').onclick = logOut;
