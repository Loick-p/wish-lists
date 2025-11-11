import './bootstrap'
import 'preline'

const activateButtonIndicator = (button) => {
    const indicatorLabel = button.querySelector('.indicator-label');
    const indicatorProgress = button.querySelector('.indicator-progress');

    button.disabled = true;
    indicatorLabel.classList.add('hidden');
    indicatorProgress.classList.remove('hidden');
}

window.activateButtonIndicator = activateButtonIndicator
