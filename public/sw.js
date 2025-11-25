self.addEventListener('push', function (e) {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
        return;
    }

    if (e.data) {
        console.log(e.data);
        var msg = e.data.json();
        // console.log(msg)
        e.waitUntil(self.registration.showNotification(msg.title, {
            body: msg.body,
            data: msg.data,
            icon: msg.icon,
            actions: msg.actions
        }));
    }
});

self.addEventListener('notificationclick', (event) => {

    const msg = event.notification.data;
    const url = msg.url;

    //let data = event.data;
    //let url = data.url;

    event.notification.close();

    event.waitUntil(
        clients
            .matchAll({
                type: "window",
            })
            .then((clientList) => {
                for (const client of clientList) {
                    if (client.url === url && "focus" in client) return client.focus();
                }
                if (clients.openWindow) return clients.openWindow(url);
            }),
    );
});
