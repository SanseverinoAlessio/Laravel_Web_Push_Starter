function urlBase64ToUint8Array(base64String) {
    var padding = '='.repeat((4 - base64String.length % 4) % 4);
    var base64 = (base64String + padding)
        .replace(/\-/g, '+')
        .replace(/_/g, '/');

    var rawData = window.atob(base64);
    var outputArray = new Uint8Array(rawData.length);

    for (var i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
}

export class browserNotificationService {
    vapidKey = '';

    constructor(vapidKey) {
        this.vapidKey = vapidKey;
    }

    async initSw() {
        if (!"serviceWorker" in navigator || !"PushManager" in window)
            return;

        try {
            await navigator.serviceWorker.register('../sw.js');
            console.log('serviceWorker installed!');
        }
        catch (e) {
            console.log('ServiceWorker not installed, an error occured: ', e);
            return;
        }

        let permissionResult = await this.initPush();
        if (permissionResult !== 'granted') {
            throw new Error('We weren\'t granted permission.');
        }

        let pushSubscription = await this.subscribeUser();
        if (!pushSubscription) {
            console.error('cannot subscribe');
            return;
        }

        this.storePushSubscription(pushSubscription);
    }

    initPush() {
        if (!navigator.serviceWorker.ready)
            return false;

        return new Promise((resolve, reject) => {
            const permissionResult = Notification.requestPermission(function (result) {
                resolve(result);
            });

            if (permissionResult) {
                permissionResult.then(resolve, reject);
            }
        });
    }

    async subscribeUser() {
        let registration = null;
        try {
            registration = await navigator.serviceWorker.ready
        }
        catch (e) {
            console.error('An Error occurred.');
            return;
        }

        const subscribeOption = {
            userVisibleOnly: true,
            applicationServerKey: urlBase64ToUint8Array(
                this.vapidKey
            )
        }

        let result = null;

        try {
            result = await registration.pushManager.subscribe(subscribeOption);
            console.log('Subscription completed!');
            console.log('Received PushSubscription: ',pushSubscription);
        }
        catch (e) {
            
        }

        return result;

    }

    storePushSubscription(pushSubscription) {
        let token = document.querySelector('meta[name=csrf-token]').getAttribute('content'); 
        fetch('/user/subscribe-to-notifications',
            {
                body: JSON.stringify(pushSubscription),
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': token
                }

            }
        ).then((res) => {
            return res.json();
        }).then((res) => {
            console.log(res);
        }).catch((e) => {
            console.error(e);
        });
    }

}