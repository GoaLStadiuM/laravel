function startProcess(price, id, goal_amount)
{
    price = parseInt(price);
    if (!Number.isInteger(price) || price < 1 || price > 500)
    {
      alert('Minimum amount is 1 BUSD and maximum amount is 500 BUSD, no decimals.');
      return;
    }

    let request = new XMLHttpRequest();
    request.open("GET", "https://api.binance.com/api/v3/ticker/price?symbol=BNBBUSD");
    request.send();
    request.onload = () => {

        let r = JSON.parse(request.response);
        price = price/r.price;
        if (price.toString().split(".")[1].length > 18) {
            price=price.toFixed(18);
        }
        EThAppDeploy.loadEtherium(price, id, goal_amount);
    }
}

function startProcessBUSD()
{
   EThAppDeploy.requestAccountBUSD();
}

EThAppDeploy = {
    loadEtherium: async (price, id, goal_amount) => {
        if (typeof window.ethereum !== 'undefined') {
            EThAppDeploy.web3Provider = ethereum;
            EThAppDeploy.requestAccount(ethereum, price, id, goal_amount);
        } else {
            alert(
                "Not able to locate an Ethereum connection, please install a Metamask wallet"
            );
        }
    },
    /****
     * Request A Account
     * **/
    requestAccount: async (ethereum, price, id, goal_amount) => {
        ethereum
            .request({
                method: 'eth_requestAccounts'
            })
            .then((resp) => {
                //do payments with activated account
                EThAppDeploy.payNow(ethereum, resp[0], price, id, goal_amount);
            })
            .catch((err) => {
                // Some unexpected error.
                console.log(err);
            });
    },
    /***
     *
     * Do Payment
     * */
    payNow: async (ethereum, from, price, id, goal_amount) => {
        var amount = price;
        ethereum
            .request({
                method: 'eth_sendTransaction',
                params: [{
                    from: from,
                    to: "0x55b42BbB7CC8C531bd4fe42C5067de487Cde45CA",
                    value: '0x' + ((amount * 1000000000000000000).toString(16)),
                    chainId: '56', // (BSC CHAIN)
                }, ],
            })
            .then((txHash) => {
                if (txHash) {
                    console.log(txHash);
                    storeTransaction(txHash, amount, price, id, goal_amount);
                } else {
                    console.log("Something went wrong. Please try again");
                }
            })
            .catch((error) => {
                console.log(error);
            });
    },
}
/***
 *
 * @param Transaction id
 *
 */
function storeTransaction(txHash, amount, price, id, goal_amount) {
    $.ajax({
        url: "/token/transaction/create",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        data: {
            txHash: txHash,
            amount: amount,
            price: price,
            goal_amount: goal_amount,
            id: id
        },
        tryCount : 0,
        retryLimit : 9,
        success: function (response) {
            // reload page after success
            gotourl = '/purchases';
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
}
