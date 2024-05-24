document.addEventListener('DOMContentLoaded', function() {
  const submitButton = document.getElementById('submitButton');
  const formBlocked = JSON.parse(document.getElementById('formBlocked').textContent);
  const unblockTime = JSON.parse(document.getElementById('unblockTime').textContent);

  function disableButton(timeLeft) {
    submitButton.disabled = true;
    let remainingTime = timeLeft;

    const interval = setInterval(() => {
      remainingTime -= 1;
      if (remainingTime <= 0) {
        clearInterval(interval);
        submitButton.disabled = false;
        alert('Форма разблокирована. Страница будет перезагружена.');
        location.reload(); // Перезагрузка страницы
      }
    }, 1000);
  }

  if (formBlocked && unblockTime) {
    const currentTime = Math.floor(Date.now() / 1000);
    const timeLeft = unblockTime - currentTime;

    if (timeLeft > 0) {
      disableButton(timeLeft);
      alert(`Форма временно заблокирована. Пожалуйста, попробуйте через ${Math.ceil(timeLeft / 60)} минут.`);
    }
  }
})

function formatPhoneFront(b) {
  let a = "+ 7 (123) 456-78-90",
    c = b.value.match(/\d/g);
  if (!c) return b.value = "+ 7 ";
  a = a.replace(/\d/g, function () {
    return c.shift() || "#"
  });
  b.value = a.replace(/#.*/, "")
}