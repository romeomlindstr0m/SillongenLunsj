document.addEventListener('DOMContentLoaded', () => {
    // Select the notification container
    const notification = document.querySelector('[aria-live="assertive"]');

    if (!notification) {
        console.error('Notification container not found.');
        return;
    }

    // Add the entering animation classes
    const notificationPanel = notification.querySelector('div.pointer-events-auto');
    if (!notificationPanel) {
        console.error('Notification panel not found.');
        return;
    }

    notificationPanel.classList.add(
        'transform',
        'ease-out',
        'duration-300',
        'translate-y-2',
        'opacity-0',
        'sm:translate-y-0',
        'sm:translate-x-2'
    );

    // Force a reflow to trigger the animation (for Safari/older browsers)
    void notificationPanel.offsetWidth;

    // Transition to the final state
    notificationPanel.classList.remove('translate-y-2', 'opacity-0', 'sm:translate-x-2');
    notificationPanel.classList.add('translate-y-0', 'opacity-100', 'sm:translate-x-0');

    // Automatically hide the notification after 5 seconds
    setTimeout(() => {
        hideNotification(notificationPanel);
    }, 5000);
});

function hideNotification(notificationPanel) {
    // Add the leaving animation classes
    notificationPanel.classList.remove('opacity-100');
    notificationPanel.classList.add('transition', 'ease-in', 'duration-100', 'opacity-0');

    // Remove the notification from view after the animation completes
    setTimeout(() => {
        notificationPanel.classList.add('hidden');
    }, 100); // Match the duration of the 'ease-in' animation
}