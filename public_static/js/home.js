const mailInfo = document.getElementById('mail-info'),
      mailInfl = document.getElementById('mail-infl'),
      mailInve = document.getElementById('mail-inve');

mailInfo.textContent = 'info@goalstadium.com';
mailInfl.textContent = 'influencers@goalstadium.com';
mailInve.textContent = 'investments@goalstadium.com';

mailInfo.href = 'mailto:info@goalstadium.com';
mailInfl.href = 'mailto:influencers@goalstadium.com';
mailInve.href = 'mailto:investments@goalstadium.com';
