import 'bootstrap/dist/js/bootstrap.bundle.min.js';

document.addEventListener('DOMContentLoaded', function() {
  setTimeout(function() {
    var successMessage = document.getElementById('success-message')
    if (successMessage) {
      successMessage.classList.add('hide')
    }
  }, 3000)

  const input_cover = document.getElementById('cover')
  if(input_cover) {
    addEventListener('change', function(event) {
      let file = event.target.files[0]

      if (file) {
        let reader = new FileReader()
        reader.onload = function(e) {
          let previewImage = document.getElementById('preview-image')
          previewImage.src = e.target.result
          previewImage.style.display = 'block'
        }
        reader.readAsDataURL(file)
      }
    })
  }
})

