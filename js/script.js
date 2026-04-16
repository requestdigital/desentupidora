const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const cards = entry.target.querySelectorAll('.servico-card');
        cards.forEach(card => card.classList.add('visivel'));
      }
    });
}, { threshold: 0.1 });

observer.observe(document.querySelector('.servicos'));

const items = document.querySelectorAll(".faq-item");

items.forEach(item => {
  item.addEventListener("click", () => {
    item.classList.toggle("active");
  });
});
