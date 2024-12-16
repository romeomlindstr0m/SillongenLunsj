document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.menu-item').forEach((item) => {
      const amountInput = item.querySelector('.amountInput');
      const increaseButton = item.querySelector('.increaseButton');
      const decreaseButton = item.querySelector('.decreaseButton');
  
      increaseButton.addEventListener('click', () => {
        amountInput.value = parseInt(amountInput.value) + 1;
      });
  
      decreaseButton.addEventListener('click', () => {
        amountInput.value = Math.max(0, parseInt(amountInput.value) - 1);
      });
    });
  });  