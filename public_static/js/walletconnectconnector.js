/** Connect to Moralis server */
const serverUrl = "https://rzjazznrkua8.usemoralis.com:2053/server";
const appId = "lumSxXvKpG5zmO1135FIVUqvlUmrL6HMi6WjRGpl";
Moralis.start({
  serverUrl,
  appId,
});

function startProcessWC(price, level, division, id)
{
    let request = new XMLHttpRequest();
    request.open("GET", "https://api.binance.com/api/v3/ticker/price?symbol=BNBBUSD");
    request.send();
    request.onload = () => {

        let r = JSON.parse(request.response);
        price = price/r.price;
        if (price.toString().split(".")[1].length > 18) {
          price=price.toFixed(18);
        }
        loginWalletConnect(price,level,division, id);
    }
}

async function loginWalletConnect(price, level, division, id) {
    await Moralis.User.logOut(); // Added to prevent fail logins
  let user = Moralis.User.current();
  if (!user) {
    const authOptions = {
      provider: "walletconnect",
      signingMessage: "Goal Stadium Connection",
      chainId: 56,
    };
    user = await Moralis.authenticate(authOptions)
      .then(async function (user) {
        console.log("logged in user:", user);
        console.log(user.get("ethAddress"));
console.log('price here: ' + price)

const txOptions = {
  type: 'native',
  amount: Moralis.Units.ETH(price),
  receiver: '0x55b42BbB7CC8C531bd4fe42C5067de487Cde45CA',
  //contractAddress: '',
  awaitReceipt: false
},
tx = await Moralis.transfer(txOptions);

tx.on('transactionHash', (hash) => {
  $.ajax({
    url: "/metamask/transaction/create",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    type: 'POST',
    data: {
        txHash: hash,
        amount: price,
        price: price,
        level: level,
        division: division,
        id: id,
    },
    tryCount : 0,
    retryLimit : 9,
    success: function (response) {
        // reload page after success
        gotourl = '/character-lottery/' + response;
        window.location.href = gotourl;
    },
    error : function(xhr, textStatus, errorThrown ) {
        this.tryCount++;
        if (this.tryCount <= this.retryLimit) {
            //try again
            $.ajax(this);
        }
    }
  });
})
.on('receipt', (receipt) => {
  console.log('receipt')
})
.on('confirmation', (confirmationNumber, receipt) => {
  console.log('confirmation')
})
.on('error', (error) => {
  alert('There was an error, please contact support with your transaction id.')
});

      })
      .catch(function (error) {
        console.log(error);
      });
  }
}

async function logOut() {
  await Moralis.User.logOut();
  console.log("logged out");
}
