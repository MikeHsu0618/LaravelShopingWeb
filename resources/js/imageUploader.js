const imageUploader = (className) => {
    const containers = document.querySelectorAll(`.${className}`);
    for (const container of containers) {
        const input = container.querySelector("input[type=file]");
        var img = document.querySelector("img");
        var oldSrc = img.src;
        input.addEventListener("change", function(e) {
            readURL(e.target);
        });
        function readURL(input) {
        if (input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e) {
                console.log(e.target.result)
                img.setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }else{
            img.setAttribute('src', oldSrc);
        }
    }
    };
}

export default imageUploader;
