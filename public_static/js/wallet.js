/* Moralis init code */
Moralis.start({ serverUrl: 'https://9iuhdje4owkr.usemoralis.com:2053/server', appId: 'DTD1H8BKuE2sSM34ppMhV5IlG0DYROpsJRHmnYKl' });

let user = Moralis.User.current();

/* Authentication code */
async function login(provider) {
  if (!user) {
    user = await Moralis.authenticate({ provider: provider, signingMessage: 'Log in using Moralis' })
      .then(function (user) {
        console.log("logged in user:", user);
        console.log(user.get("ethAddress"));
      })
      .catch(function (error) {
        console(error);
      });
  }
}

async function logOut() {
  await Moralis.User.logOut();
  console.log('logged out');
}

document.getElementById('btn-login-metamask').onclick = login('metamask');
document.getElementById('btn-login-walletconnect').onclick = login('walletconnect');
document.getElementById('btn-logout').onclick = logOut;
