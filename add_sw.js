// Este código verifica a disponibilidade da API de service worker. 
// Se disponível, o service worker, é registrado quando a página está carregada.
// https://developers.google.com/web/fundamentals/codelabs/push-notifications/?hl=pt-br

// const applicationServerPublicKey = 'BJ_oT5lY8XF3qf7v5f-8WRhgzyXpuJn-aJTX-mImqDNWDDNt3-d3w57aZtj_7hk37hEb7RvHW7pS9U7R1YMwPrs';

// const pushButton = document.querySelector('.js-push-btn');

// let isSubscribed = false;
let swRegistration = null;

function urlB64ToUint8Array(base64String) {
  const padding = '='.repeat((4 - base64String.length % 4) % 4);
  const base64 = (base64String + padding)
    .replace(/\-/g, '+')
    .replace(/_/g, '/');

  const rawData = window.atob(base64);
  const outputArray = new Uint8Array(rawData.length);

  for (let i = 0; i < rawData.length; ++i) {
    outputArray[i] = rawData.charCodeAt(i);
  }
  return outputArray;
}

// Verifique a compatibilidade do navegador em que estamos executando isso
// if ('serviceWorker' in navigator && 'PushManager' in window) {
if ('serviceWorker' in navigator) {
  window.addEventListener('load', function() {
    navigator.serviceWorker.register('serviceworker.js').then(function(registration) {
      // Registration was successful
      // console.log('[ServiceWorker] registrado com sucesso: ', registration.scope);
      // console.log('[ServiceWorker] detalhes: ', registration);
      // para o evento Push
      swRegistration = registration;
      // initialiseUI();
    }, function(err) {
      // registration failed :(
      // console.log('[ServiceWorker] Falha ao registrar: ', err);
    });
  });
}else{
  console.warn('Push messaging is not supported');
  // pushButton.textContent = 'Push Not Supported';
}

// function initialiseUI() {
  // pushButton.addEventListener('click', function() {
  //   pushButton.disabled = true;
  //   if (isSubscribed) {
  //     // TODO: cancelar a inscrição do usuário
  //   } else {
  //     subscribeUser();
  //   }
  // });

  // // Definir o valor da assinatura inicial
  // swRegistration.pushManager.getSubscription()
  // .then(function(subscription) {
  //   isSubscribed = !(subscription === null);

  //   updateSubscriptionOnServer(subscription);

  //   if (isSubscribed) {
  //     console.log('Usuário inscrito.');
  //   } else {
  //     console.log('O usuário NÃO está inscrito.');
  //   }

  //   updateBtn();
  // });
// }

// function updateBtn() {
//   if (Notification.permission === 'denied') {
//     pushButton.textContent = 'Mensagem push bloqueada.';
//     pushButton.disabled = true;
//     updateSubscriptionOnServer(null);
//     return;
//   }

//   if (isSubscribed) {
//     pushButton.textContent = 'Desativar mensagens push';
//   } else {
//     pushButton.textContent = 'Ativar mensagens push';
//   }

//   pushButton.disabled = false;
// }

// function subscribeUser() {
//   const applicationServerKey = urlB64ToUint8Array(applicationServerPublicKey);
//   swRegistration.pushManager.subscribe({
//     userVisibleOnly: true,
//     applicationServerKey: applicationServerKey
//   })
//   .then(function(subscription) {
//     console.log('Usuário inscrito:', subscription);

//     updateSubscriptionOnServer(subscription);

//     isSubscribed = true;

//     updateBtn();
//   })
//   .catch(function(err) {
//     console.log('Falha ao inscrever o usuário: ', err);
//     updateBtn();
//   });
// }

// function updateSubscriptionOnServer(subscription) {
//   // TODO: Enviar assinatura para o servidor de aplicativos //?

//   const subscriptionJson = document.querySelector('.js-subscription-json');
//   const subscriptionDetails =
//     document.querySelector('.js-subscription-details');

//   if (subscription) {
//     subscriptionJson.textContent = JSON.stringify(subscription);
//     subscriptionDetails.classList.remove('is-invisible');
//   } else {
//     subscriptionDetails.classList.add('is-invisible');
//   }
// }