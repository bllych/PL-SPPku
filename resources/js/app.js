document.addEventListener('submit', (event) => {
    const form = event.target;

    if (!(form instanceof HTMLFormElement) || !form.hasAttribute('data-confirm-logout')) {
        return;
    }

    if (!window.confirm('Apakah kamu yakin ingin logout?')) {
        event.preventDefault();
    }
});

document.querySelectorAll('[data-payment-flow]').forEach((paymentFlow) => {
    const openButton = paymentFlow.querySelector('[data-payment-open]');
    const summaryDialog = paymentFlow.querySelector('[data-payment-summary]');
    const confirmationDialog = paymentFlow.querySelector('[data-payment-confirmation]');
    const feedback = paymentFlow.querySelector('[data-payment-feedback]');

    if (!(openButton instanceof HTMLButtonElement)
        || !(summaryDialog instanceof HTMLDialogElement)
        || !(confirmationDialog instanceof HTMLDialogElement)
        || !(feedback instanceof HTMLParagraphElement)) {
        return;
    }

    openButton.addEventListener('click', () => {
        feedback.hidden = true;
        summaryDialog.showModal();
    });

    paymentFlow.querySelectorAll('[data-summary-close]').forEach((button) => {
        button.addEventListener('click', () => summaryDialog.close());
    });

    paymentFlow.querySelector('[data-payment-continue]')?.addEventListener('click', () => {
        summaryDialog.close();
        confirmationDialog.showModal();
    });

    paymentFlow.querySelector('[data-confirm-back]')?.addEventListener('click', () => {
        confirmationDialog.close();
        summaryDialog.showModal();
    });

    paymentFlow.querySelector('[data-payment-confirm]')?.addEventListener('click', () => {
        confirmationDialog.close();
        feedback.textContent = 'Konfirmasi dicatat untuk demo. Pembayaran belum diproses dan status tagihan tidak berubah.';
        feedback.hidden = false;
    });
});
