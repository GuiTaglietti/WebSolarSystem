// JS file used for transitions animation

window.transitionToPage = function(href) {
    document.querySelector('body').style.opacity = 0
    setTimeout(function() { 
        window.location.href = href
    }, 500)
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('body').style.opacity = 1
})
