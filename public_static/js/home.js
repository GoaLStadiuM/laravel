const mailInfo = document.getElementById('mail-info'),
      mailInfl = document.getElementById('mail-infl'),
      mailInve = document.getElementById('mail-inve'),
      nftBenja = document.getElementById('nft-benja'),
      nftCrisnaldo = document.getElementById('nft-crisnaldo'),
      nftPeque = document.getElementById('nft-peque'),
      nftSinedine = document.getElementById('nft-sinedine');

mailInfo.textContent = 'info@goalstadium.com';
mailInfl.textContent = 'influencers@goalstadium.com';
mailInve.textContent = 'investments@goalstadium.com';

mailInfo.href = 'mailto:info@goalstadium.com';
mailInfl.href = 'mailto:influencers@goalstadium.com';
mailInve.href = 'mailto:investments@goalstadium.com';

nftBenja.addEventListener('mouseover', () => nftBenja.play());
nftBenja.addEventListener('mouseout', () => nftBenja.pause());
nftCrisnaldo.addEventListener('mouseover', () => nftCrisnaldo.play());
nftCrisnaldo.addEventListener('mouseout', () => nftCrisnaldo.pause());
nftPeque.addEventListener('mouseover', () => nftPeque.play());
nftPeque.addEventListener('mouseout', () => nftPeque.pause());
nftSinedine.addEventListener('mouseover', () => nftSinedine.play());
nftSinedine.addEventListener('mouseout', () => nftSinedine.pause());
