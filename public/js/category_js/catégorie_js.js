
// ************LOADER


// ************END LOADER


// When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size
window.onscroll = function () { scrollFunction() };
var navbar = document.getElementById("navbar");
function scrollFunction() {
    if (document.documentElement.scrollTop > 10) {
        navbar.style.padding = "1px 10px";
        navbar.classList.add("sticky");
        navbar.style.height = "60px"
    } else {
        navbar.style.padding = "15px 10px";
        navbar.style.height = "90px"
        navbar.classList.remove("sticky");
    }
}


// ***************SIDEBAR REMOVE
// const footer = document.querySelector("#footer");
// const sidebar = document.getElementById("sidebar")
// const card_container = document.querySelector(".container_modif")
// var options = {};

// const observer = new IntersectionObserver(function (entries, observer) {
//     entries.forEach(entry => {
//         if (entry.isIntersecting) {
//             sidebar.style.display = 'none';
//         }
//         else {
//             sidebar.style.display = "unset";

//         }
//     });
// }, options);
// observer.observe(footer)



// **************END SIDEBAR REMOVE




//  The fade_in when scrolling
const faders = document.querySelectorAll('.fade_in');
const appearOptions = {
    threshold: 0,
    rootMargin: "0px 0px -200px 0px"
};
const appearOnScroll = new IntersectionObserver(function (entries, appearOnScroll) {
    entries.forEach(entry => {
        if (!entry.isIntersecting)
            return;
        else {
            entry.target.classList.add('appear')
            appearOnScroll.unobserve(entry.target)
            // POUR AJOUTER LES EFFETS D'ANIMATION DE FUR ET A MESURE QU'ON SCROLLE
            for (let i = 0; i < entry.target.classList.length; i++) {
                if (entry.target.classList[i] == "container_card") {
                    entry.target.firstElementChild.firstElementChild.firstElementChild.classList.add('card__image')
                    entry.target.firstElementChild.firstElementChild.nextElementSibling.lastElementChild.classList.add('card__line')
                }
            }
        }
    })
}, appearOptions)

faders.forEach(fader => {
    appearOnScroll.observe(fader)
})


window.onload = navbar_dropdown()
function navbar_dropdown() {
    var dropitem1 = $("#dropitem1")
    var ddm1 = $("#ddm1")
    // wakt nokherjou mel dropdown catégories fel navbar, la liste d'éléments tetnaha
    dropitem1.on("mouseleave", function () {
        ddm1.removeClass("show");
    })

    // wakt nodkhlou lel dropdown catégories fel navbar, la liste d'éléments todhhor
    dropitem1.on("mouseover", function () {
        ddm1.addClass("show");
    })

    // wakt nokherjou mel dropdown mini-jeux fel navbar, la liste d'éléments tetnaha
    var dropitem2 = $("#dropitem2")
    var ddm2 = $("#ddm2")
    dropitem2.on("mouseleave", function () {
        ddm2.removeClass("show");
    })

    // wakt nodkhlou lel dropdown mini-jeux fel navbar, la liste d'éléments todhhor
    dropitem2.on("mouseover", function () {
        ddm2.addClass("show");
    })
}

