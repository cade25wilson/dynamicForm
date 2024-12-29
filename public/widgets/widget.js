document.addEventListener("DOMContentLoaded", (function() {
    ! function(t) {
        const e = document.createElement("link");
        e.rel = "stylesheet", e.href = t, document.head.appendChild(e)
    }("https://buildmyform.com/widgets/widget.css?v=3");
    document.querySelectorAll("[data-buildmyform-open]").forEach((function(t) {
        t.addEventListener("click", (function() {
            event.preventDefault();
            const e = t.getAttribute("data-buildmyform-open");
            let o = t.getAttribute("data-buildmyform-position");
            o || (o = "center"),
                function(t, e) {
                    let o = document.querySelector(".buildmyform-modal-overlay");
                    o || (o = document.createElement("div"), o.classList.add("buildmyform-modal-overlay"), "center" == e && o.classList.add("as-modal"));
                    const n = document.createElement("div");
                    n.classList.add("buildmyform-modal-content"), "center" != e && n.classList.add("bottom-right");
                    const d = document.createElement("button");
                    d.classList.add("buildmyform-close-button"), d.appendChild(function() {
                        const t = document.createElementNS("http://www.w3.org/2000/svg", "svg");
                        return t.setAttribute("xmlns", "http://www.w3.org/2000/svg"), t.setAttribute("viewBox", "0 0 24 24"), t.setAttribute("width", "30"), t.setAttribute("height", "30"), t.innerHTML = '<path fill="currentColor" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path>', t
                    }()), d.addEventListener("click", r), n.appendChild(d);
                    const c = document.createElement("iframe");
                    c.src = `https://buildmyform.com/forms/${t}`, c.frameBorder = 0, n.appendChild(c), o.appendChild(n), document.body.appendChild(o), o.addEventListener("click", (function(t) {
                        t.target === o && r()
                    }));
                    document.getElementsByTagName("body")[0];

                    function r() {
                        document.body.removeChild(o), document.body.style.overflow = "auto"
                    }
                    document.body.style.overflow = "hidden"
                }(e, o)
        }))
    }))
}));