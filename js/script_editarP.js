    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };

    var loadFileBanner = function(event) {
        var image = document.getElementById('outputBanner');
        image.src = URL.createObjectURL(event.target.files[0]);
    };








