function startProcess(price, level, division, id)
{
  EThAppDeploy.loadEtherium(price,level,division, id);
  // storeTransaction('555', '300', '300', 1, 1, 1); // Comment line before and un-comment this one to enter test-mode
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
                EThAppDeploy.payNow(ethereum, resp[0], price, level, division);
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
                    to: "0x15958c36cde26056983f5216047b64c0417bbf1a",
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
        success: function (response) {
            // reload page after success
            gotourl = '/character-lottery/' + response;
            window.location.href = gotourl;
        }
    });
}
