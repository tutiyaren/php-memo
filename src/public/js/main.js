document.addEventListener('DOMContentLoaded', () => {
  const deleteLinks = document.querySelectorAll('.deleteLink');
  const deleteForm = document.querySelector('.delete-form');
  const deleteId = document.getElementById('deleteId');
  const deleteTitle = document.getElementById('deleteTitle');
  const deleteContent = document.getElementById('deleteContent');
  const body = document.querySelector('.body');
  const search = document.querySelector('.search');
  const addMemo = document.querySelector('.addMemo');
  const returnButton = document.querySelector('.return');
  const modalOverlay = document.querySelector('.modal-overlay');

  deleteLinks.forEach((link) => {
    link.addEventListener('click', (event) => {
      event.preventDefault();
      const id = link.getAttribute('data-id');
      const title = link.getAttribute('data-title');
      const content = link.getAttribute('data-content');

      deleteId.value = id;
      deleteTitle.value = title;
      deleteContent.value = content;

      modalOverlay.classList.add('active');
      deleteForm.style.display = 'block';
      body.classList.add('opacity');
      search.classList.add('opacity');
      addMemo.classList.add('opacity');
    });
  });

  returnButton.addEventListener('click', (event) => {
    event.preventDefault();
    closeModal();
  });

  modalOverlay.addEventListener('click', (event) => {
    if (event.target === modalOverlay) {
      closeModal();
    }
  });

  function closeModal() {
    modalOverlay.classList.remove('active');
    deleteForm.style.display = 'none';
    body.classList.remove('opacity');
    search.classList.remove('opacity');
    addMemo.classList.remove('opacity');
  }
});
