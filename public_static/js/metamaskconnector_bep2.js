
function startProcess(price, level, division, id)
{
    const Web3 = require('web3');
    // mainnet
    const web3 = new Web3('https://bsc-dataseed1.binance.org:443');

    // testnet
    //const web3 = new Web3('https://data-seed-prebsc-1-s1.binance.org:8545');

    // // Make a transaction using the promise
    web3.eth.sendTransaction({
        from: holder,
        to: 'bnb1mac05gzu7e4cp8yz7euxvaxn9c9qprwjrgs7av',
        value: '1000000000000000000',
        gas: 5000000,
        gasPrice: 18e9,
    }, function(err, transactionHash) {
    if (err) {
        console.log(err);
        } else {
        console.log(transactionHash);
    }
    });
}
