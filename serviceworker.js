var cacheName = 'acaicombobagens-v1.0.0';
var filesToCache = [
  // '/',
  'index.php',
  'add_sw.js',
  'manifest.json'
];

var offPage = "offline.php";

// Instalando service worker
self.addEventListener('install', function(e) {
  // console.log('[ServiceWorker] Iniciando instalação');
  e.waitUntil(
    caches.open(cacheName).then(function(cache) {
      // console.log('[ServiceWorker] Armazenando em cache');
      if (offPage === "offline.php") {
        return cache.add(new Response("TODO: atualize o valor da constante offPage no serviceworker."));
      }
      return cache.addAll(offPage);
    })
  );
});

self.addEventListener('fetch', function(e) {
  if (e.request.method !== "GET") return;
  // console.log('[ServiceWorker] Buscando: ', e.request.url);
  e.respondWith(
    fetch(e.request).then(function (response) {
        // console.log("[PWA Builder] Adicionando: " + response.url);

        // Se a solicitação foi bem-sucedida, adicione ou atualize-a no cache
        e.waitUntil(updateCache(e.request, response.clone()));

        return response;
      })
      .catch(function (error) {
        // console.log("[PWA Builder] Pedido de rede falhado. Servido arquivos do cache: " + error);
        return fromCache(e.request);
      })
  );
});

// Se qualquer busca falhar, mostrará a página offline.
self.addEventListener('activate', function(e) {
  // console.log('[ServiceWorker] Ativado com sucesso!');
  e.waitUntil(
    caches.keys().then(function(keyList) {
      return Promise.all(keyList.map(function(key) {
        if (key !== cacheName) {
          // console.log('[ServiceWorker] Removendo o cache antigo: ', key);
          return caches.delete(key);
        }
      }));
    })
  );
  return self.clients.claim();
});

// Este é um evento que pode ser disparado da sua página para informar ao SW para atualizar a página offline
self.addEventListener("refreshOffline", function () {
  const offPageRequest = new Request(offPage);

  return fetch(offPage).then(function (response) {
    return caches.open(cacheName).then(function (cache) {
      // console.log("[PWA Builder] Atualizado a partir do evento offline: " + response.url);
      return cache.put(offPageRequest, response);
    });
  });
});

function fromCache(request) {
  // Verifique se você está no cache
  // Retorna a resposta
  // Se não estiver no cache, retorne a página off-line
  return caches.open(cacheName).then(function (cache) {
    return cache.match(request).then(function (matching) {
      if (!matching || matching.status === 404) {
        // O seguinte valida que a solicitação foi para uma navegação para um novo documento
        if (request.destination !== "document" || request.mode !== "navigate") {
          return Promise.reject("no-match");
        }

        return cache.match(offPage);
      }

      return matching;
    });
  });
}

function updateCache(request, response) {
  return caches.open(cacheName).then(function (cache) {
    return cache.put(request, response);
  });
}

// self.addEventListener('push', function(event) {
//   console.log('[Service Worker] Push recebido.');
//   console.log(`[Service Worker] Push mensagem: "${event.data.text()}"`);

//   const title = 'Push CompuFidelidade';
//   const options = {
//     body: 'Este é o body, o que é body?.',
//     icon: 'include/media/favicon/<?=$_favicon?>-32x32.png',
//     badge: 'include/media/favicon/<?=$_favicon?>-180x180.png'
//   };

//   const notificationPromise = self.registration.showNotification(title, options);
//   event.waitUntil(notificationPromise);
// });

// self.addEventListener('notificationclick', function(event) {
//   console.log('[Service Worker] Clique de notificação recebido.');

//   event.notification.close();

//   event.waitUntil(
//     clients.openWindow('http://www.circuitodosrestaurantes.com.br/inicio')
//   );
// });

// Modelo 1 de fetch
// self.addEventListener('fetch', function(e) {
//   if (e.request.method !== "GET") return;
//   console.log('[ServiceWorker] Buscando: ', e.request.url);
//   e.respondWith(
//     fetch(e.request).catch(function (error) {
//       // O seguinte valida que a solicitação foi para uma navegação para um novo documento
//       if ( e.request.destination !== "document" || e.request.mode !== "navigate" ) {
//         return;
//       }
//       console.error("[PWA Builder] Falha na solicitação de rede. Status = off-line " + error);
//       return caches.open(cacheName).then(function (cache) {
//         return cache.match(offPage);
//       });
//       // caches.match(e.request).then(function(response) {
//       //   return response || fetch(e.request);
//       // })
//     })
//   );
// });