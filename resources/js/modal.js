const openModal = document.querySelector('.openModal');
const closeModal = document.querySelector('.closeModal');
const modal = document.querySelector('.modal');

openModal.addEventListener('click', () => {
    modal.showModal()
})
closeModal.addEventListener('click', () => {
    modal.close()
})
modal.addEventListener('click', (e) => {
    console.log(e.target)
    if(e.target === modal) modal.close()
})
