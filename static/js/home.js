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

nftBenja.closest('.third-team-item').addEventListener('mouseover', () => nftBenja.play());
nftBenja.closest('.third-team-item').addEventListener('mouseout', () => nftBenja.pause());
nftCrisnaldo.closest('.third-team-item').addEventListener('mouseover', () => nftCrisnaldo.play());
nftCrisnaldo.closest('.third-team-item').addEventListener('mouseout', () => nftCrisnaldo.pause());
nftPeque.closest('.third-team-item').addEventListener('mouseover', () => nftPeque.play());
nftPeque.closest('.third-team-item').addEventListener('mouseout', () => nftPeque.pause());
nftSinedine.closest('.third-team-item').addEventListener('mouseover', () => nftSinedine.play());
nftSinedine.closest('.third-team-item').addEventListener('mouseout', () => nftSinedine.pause());
