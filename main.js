const fileInput = document.querySelector('input[type="file"]');
fileInput.addEventListener('change', () => {
  const fileName = fileInput.files[0].name;
  console.log('Selected file:', fileName);
});