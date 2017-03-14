jQuery(document).on('click', 'video', function(){
    if (this.paused) {
        console.log("play!");
        this.play();
    } else {
        console.log("pause!");
        this.pause();
    }
});
