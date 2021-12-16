function startProcess(price, level, division, id)
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
        EThAppDeploy.loadEtherium(price,level,division, id);
    }
}

function startProcessBUSD()
{
   EThAppDeploy.requestAccountBUSD();
}

EThAppDeploy = {
    loadEtherium: async (price,level,division, id) => {
        if (typeof window.ethereum !== 'undefined') {
            EThAppDeploy.web3Provider = ethereum;
            EThAppDeploy.requestAccount(ethereum, price, level, division, id);
        } else {
            alert(
                "Not able to locate an Ethereum connection, please install a Metamask wallet"
            );
        }
    },
    /****
     * Request A Account
     * **/
    requestAccount: async (ethereum, price, level, division, id) => {
        ethereum
            .request({
                method: 'eth_requestAccounts'
            })
            .then((resp) => {
                //do payments with activated account
                EThAppDeploy.payNow(ethereum, resp[0], price, level, division, id);
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
    payNow: async (ethereum, from, price, level, division, id) => {
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
                    storeTransaction(txHash, amount, price, level, division, id);
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
function storeTransaction(txHash, amount, price, level, division, id) {
    $.ajax({
        url: "/metamask/transaction/create",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        data: {
            txHash: txHash,
            amount: amount,
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
}
