const image = document.getElementById('image_click');
const input_file_hidden = document.getElementById('input_file_hidden');

image.addEventListener('click',function(){
    input_file_hidden.click()
})

input_file_hidden.addEventListener('change', function(e){
    const file = e.target.files[0];
    console.log(file)

    const reader =new FileReader()
    reader.onload = function(e){
        image.src = e.target.result
    }
    reader.readAsDataURL(file)
    image.style.width = '200px'
})
