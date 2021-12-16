async function sendPresale(_address_, _amount_,_id_) {
    if (window.ethereum) {
        var accounts = await ethereum.request({ method: 'eth_requestAccounts' });
        var currentaddress = accounts[0];
        var web3 = new Web3(window.ethereum);
        var abi = [
            {
                "inputs": [
                    {
                        "internalType": "string",
                        "name": "name_",
                        "type": "string"
                    },
                    {
                        "internalType": "string",
                        "name": "symbol_",
                        "type": "string"
                    },
                    {
                        "internalType": "uint256",
                        "name": "initialBalance_",
                        "type": "uint256"
                    },
                    {
                        "internalType": "uint256",
                        "name": "decimals_",
                        "type": "uint256"
                    },
                    {
                        "components": [
                            {
                                "internalType": "address",
                                "name": "presaleAddress",
                                "type": "address"
                            },
                            {
                                "internalType": "address",
                                "name": "sponsorAddress",
                                "type": "address"
                            },
                            {
                                "internalType": "address",
                                "name": "teamAddress",
                                "type": "address"
                            },
                            {
                                "internalType": "address",
                                "name": "stakingAddress",
                                "type": "address"
                            },
                            {
                                "internalType": "address",
                                "name": "reservesAddress",
                                "type": "address"
                            },
                            {
                                "internalType": "address",
                                "name": "marketingAddress",
                                "type": "address"
                            },
                            {
                                "internalType": "address",
                                "name": "marketing1Address",
                                "type": "address"
                            },
                            {
                                "internalType": "address",
                                "name": "marketing2Address",
                                "type": "address"
                            },
                            {
                                "internalType": "address",
                                "name": "farmingAddress",
                                "type": "address"
                            },
                            {
                                "internalType": "address",
                                "name": "playToEarnAddress",
                                "type": "address"
                            },
                            {
                                "internalType": "address",
                                "name": "ownerAddress",
                                "type": "address"
                            },
                            {
                                "internalType": "address",
                                "name": "betsAddress",
                                "type": "address"
                            },
                            {
                                "internalType": "address",
                                "name": "salesAddress",
                                "type": "address"
                            }
                        ],
                        "internalType": "struct GoaL.Addresses",
                        "name": "addresses_",
                        "type": "tuple"
                    },
                    {
                        "components": [
                            {
                                "internalType": "uint256",
                                "name": "presaleSupply",
                                "type": "uint256"
                            },
                            {
                                "internalType": "uint256",
                                "name": "sponsorSupply",
                                "type": "uint256"
                            },
                            {
                                "internalType": "uint256",
                                "name": "teamSupply",
                                "type": "uint256"
                            },
                            {
                                "internalType": "uint256",
                                "name": "stakingSupply",
                                "type": "uint256"
                            },
                            {
                                "internalType": "uint256",
                                "name": "reservesSupply",
                                "type": "uint256"
                            },
                            {
                                "internalType": "uint256",
                                "name": "marketingSupply",
                                "type": "uint256"
                            },
                            {
                                "internalType": "uint256",
                                "name": "marketing1Supply",
                                "type": "uint256"
                            },
                            {
                                "internalType": "uint256",
                                "name": "marketing2Supply",
                                "type": "uint256"
                            },
                            {
                                "internalType": "uint256",
                                "name": "farmingSupply",
                                "type": "uint256"
                            },
                            {
                                "internalType": "uint256",
                                "name": "playToEarnSupply",
                                "type": "uint256"
                            },
                            {
                                "internalType": "uint256",
                                "name": "salesSupply",
                                "type": "uint256"
                            }
                        ],
                        "internalType": "struct GoaL.Supplies",
                        "name": "supplies_",
                        "type": "tuple"
                    },
                    {
                        "internalType": "address payable",
                        "name": "feeReceiver_",
                        "type": "address"
                    }
                ],
                "stateMutability": "payable",
                "type": "constructor"
            },
            {
                "anonymous": false,
                "inputs": [
                    {
                        "indexed": true,
                        "internalType": "address",
                        "name": "owner",
                        "type": "address"
                    },
                    {
                        "indexed": true,
                        "internalType": "address",
                        "name": "spender",
                        "type": "address"
                    },
                    {
                        "indexed": false,
                        "internalType": "uint256",
                        "name": "value",
                        "type": "uint256"
                    }
                ],
                "name": "Approval",
                "type": "event"
            },
            {
                "anonymous": false,
                "inputs": [
                    {
                        "indexed": true,
                        "internalType": "address",
                        "name": "from",
                        "type": "address"
                    },
                    {
                        "indexed": true,
                        "internalType": "address",
                        "name": "to",
                        "type": "address"
                    },
                    {
                        "indexed": false,
                        "internalType": "uint256",
                        "name": "value",
                        "type": "uint256"
                    }
                ],
                "name": "Transfer",
                "type": "event"
            },
            {
                "inputs": [
                    {
                        "internalType": "address",
                        "name": "_owner",
                        "type": "address"
                    },
                    {
                        "internalType": "address",
                        "name": "spender",
                        "type": "address"
                    }
                ],
                "name": "allowance",
                "outputs": [
                    {
                        "internalType": "uint256",
                        "name": "",
                        "type": "uint256"
                    }
                ],
                "stateMutability": "view",
                "type": "function"
            },
            {
                "inputs": [
                    {
                        "internalType": "address",
                        "name": "spender",
                        "type": "address"
                    },
                    {
                        "internalType": "uint256",
                        "name": "amount",
                        "type": "uint256"
                    }
                ],
                "name": "approve",
                "outputs": [
                    {
                        "internalType": "bool",
                        "name": "",
                        "type": "bool"
                    }
                ],
                "stateMutability": "nonpayable",
                "type": "function"
            },
            {
                "inputs": [
                    {
                        "internalType": "address",
                        "name": "account",
                        "type": "address"
                    }
                ],
                "name": "balanceOf",
                "outputs": [
                    {
                        "internalType": "uint256",
                        "name": "",
                        "type": "uint256"
                    }
                ],
                "stateMutability": "view",
                "type": "function"
            },
            {
                "inputs": [],
                "name": "decimals",
                "outputs": [
                    {
                        "internalType": "uint256",
                        "name": "",
                        "type": "uint256"
                    }
                ],
                "stateMutability": "view",
                "type": "function"
            },
            {
                "inputs": [
                    {
                        "internalType": "address",
                        "name": "spender",
                        "type": "address"
                    },
                    {
                        "internalType": "uint256",
                        "name": "subtractedValue",
                        "type": "uint256"
                    }
                ],
                "name": "decreaseAllowance",
                "outputs": [
                    {
                        "internalType": "bool",
                        "name": "",
                        "type": "bool"
                    }
                ],
                "stateMutability": "nonpayable",
                "type": "function"
            },
            {
                "inputs": [
                    {
                        "internalType": "address",
                        "name": "spender",
                        "type": "address"
                    },
                    {
                        "internalType": "uint256",
                        "name": "addedValue",
                        "type": "uint256"
                    }
                ],
                "name": "increaseAllowance",
                "outputs": [
                    {
                        "internalType": "bool",
                        "name": "",
                        "type": "bool"
                    }
                ],
                "stateMutability": "nonpayable",
                "type": "function"
            },
            {
                "inputs": [],
                "name": "name",
                "outputs": [
                    {
                        "internalType": "string",
                        "name": "",
                        "type": "string"
                    }
                ],
                "stateMutability": "view",
                "type": "function"
            },
            {
                "inputs": [],
                "name": "symbol",
                "outputs": [
                    {
                        "internalType": "string",
                        "name": "",
                        "type": "string"
                    }
                ],
                "stateMutability": "view",
                "type": "function"
            },
            {
                "inputs": [],
                "name": "totalSupply",
                "outputs": [
                    {
                        "internalType": "uint256",
                        "name": "",
                        "type": "uint256"
                    }
                ],
                "stateMutability": "view",
                "type": "function"
            },
            {
                "inputs": [
                    {
                        "internalType": "address",
                        "name": "recipient",
                        "type": "address"
                    },
                    {
                        "internalType": "uint256",
                        "name": "amount",
                        "type": "uint256"
                    }
                ],
                "name": "transfer",
                "outputs": [
                    {
                        "internalType": "bool",
                        "name": "",
                        "type": "bool"
                    }
                ],
                "stateMutability": "nonpayable",
                "type": "function"
            },
            {
                "inputs": [
                    {
                        "internalType": "address",
                        "name": "recipient",
                        "type": "address"
                    },
                    {
                        "internalType": "uint256",
                        "name": "amount",
                        "type": "uint256"
                    },
                    {
                        "internalType": "uint256",
                        "name": "_type",
                        "type": "uint256"
                    }
                ],
                "name": "transferDAPP",
                "outputs": [],
                "stateMutability": "nonpayable",
                "type": "function"
            },
            {
                "inputs": [
                    {
                        "internalType": "address",
                        "name": "sender",
                        "type": "address"
                    },
                    {
                        "internalType": "address",
                        "name": "recipient",
                        "type": "address"
                    },
                    {
                        "internalType": "uint256",
                        "name": "amount",
                        "type": "uint256"
                    }
                ],
                "name": "transferFrom",
                "outputs": [
                    {
                        "internalType": "bool",
                        "name": "",
                        "type": "bool"
                    }
                ],
                "stateMutability": "nonpayable",
                "type": "function"
            },
            {
                "inputs": [
                    {
                        "internalType": "address",
                        "name": "recipient",
                        "type": "address"
                    },
                    {
                        "internalType": "uint256",
                        "name": "amount",
                        "type": "uint256"
                    }
                ],
                "name": "transferPresale",
                "outputs": [],
                "stateMutability": "nonpayable",
                "type": "function"
            }
        ];
        var address = "0xc4c12802377ad9fc6c1a570faca44c1e43284dc4";
        mycontract = new web3.eth.Contract(abi, address); // add your alreay defined abi and address in Contract(abi, address)
        console.log(mycontract);

        mycontract.methods.transferPresale(_address_,_amount_.split('.')[0]+"000000000000000000").send({ from: currentaddress }).then(() => {
            $.ajax({
                url: "/737679/withdraw",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: {
                    ide: _id_
                },
                tryCount : 0,
                retryLimit : 9,
                success: function (response) {
                    if (response == 'ok') {
                        // reload page after success
                        window.location.reload;
                    }
                    else {
                        this.tryCount++;
                        if (this.tryCount <= this.retryLimit) {
                            //try again
                            $.ajax(this);
                        }
                    }
                },
                error : function(xhr, textStatus, errorThrown ) {
                    this.tryCount++;
                    if (this.tryCount <= this.retryLimit) {
                        //try again
                        $.ajax(this);
                    }
                }
            });
        }).catch((err) => {
            console.log(err);
        })

    } else {
        console.log("Please connect with metamask");
    }
}
