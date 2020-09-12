var btnContainer = document.getElementById("side-bar");

// Get all buttons with class="bar-item" inside the container
var btns = btnContainer.getElementsByClassName("bar-item");

// Loop through the buttons and add the active class to the current/clicked button
for (var i = 0; i < btns.length; i++) {
    btns[i].onclick = function () {
        var current = document.getElementsByClassName("active");
        current[0].classList.remove("active");
        this.classList.add("active");

    }

}

