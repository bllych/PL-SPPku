document.addEventListener('submit', (event) => {
    const form = event.target;

    if (!(form instanceof HTMLFormElement) || !form.hasAttribute('data-confirm-logout')) {
        return;
    }

    if (!window.confirm('Apakah kamu yakin ingin logout?')) {
        event.preventDefault();
    }
});
