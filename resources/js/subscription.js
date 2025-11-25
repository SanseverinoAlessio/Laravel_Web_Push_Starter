import { browserNotificationService } from "./browser-notification-service";

$(function () {
    $('.subscription-to-notifications').on('click',subscriptionToNotifications);
});

function subscriptionToNotifications(e) {
    e.preventDefault();
    console.log(import.meta.env.VITE_VAPID_PUBLIC_KEY);
    let notificationService = new browserNotificationService(import.meta.env.VITE_VAPID_PUBLIC_KEY);
    notificationService.initSw();
}

