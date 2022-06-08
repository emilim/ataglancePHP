class FlexElement extends HTMLElement {
    constructor() {
        super();
        this.addEventListener('click', handleClick);
        this.addEventListener('long-press', this.handleContextMenu);
        $(this).contextmenu(this.handleContextMenu);
    }

    connectedCallback() {
        this.style.display = 'flex';
        this.style.alignItems = 'center';
        this.style.justifyContent = 'center';
        this.style.flex = this.getAttribute('flex') || '1';
        this.style.background = this.getAttribute('color') || 'blue';
        this.innerHTML = this.getAttribute('text') || '';
    }
    handleContextMenu(ev) {
        const rgb2hex = (rgb) => `#${rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/).slice(1).map(n => parseInt(n, 10).toString(16).padStart(2, '0')).join('')}`;
        hideMenu();
        ev.preventDefault();
        var menu = document.getElementById("rmenu");
        var textArea = document.getElementById("boxInfo");
        var send = document.getElementById("send");
        var color = document.getElementById("color");

        $("#send").click(function () {
            ev.target.innerHTML = textArea.value;
            ev.target.style.background = color.value;
            hideMenu();
        });
        $("#verticalSplit").click(function () {
            if (ev.target.parentNode.getAttribute('class') == null) {
                ev.target.parentNode.setAttribute('class', 'h');
            }
            if (ev.target.parentNode.getAttribute('class') == 'h') {
                var newElement = document.createElement('flex-element');
                newElement.setAttribute('color', getRandomColor());
                newElement.setAttribute('flex', '1');
                newElement.setAttribute('text', 'new element');
                var bar = document.createElement('flex-resizer');
                //ev.target.parentNode.appendChild(bar);
                //ev.target.parentNode.appendChild(newElement);

                ev.target.parentNode.insertBefore(newElement, ev.target.nextSibling);
                ev.target.parentNode.insertBefore(bar, newElement);
            }
            if (ev.target.parentNode.getAttribute('class') == 'v') {
                var newFlex = document.createElement('flex');

                var newElement = document.createElement('flex-element');
                newElement.setAttribute('color', getRandomColor());
                newElement.setAttribute('flex', '1');
                newElement.setAttribute('text', 'new element');
                var bar = document.createElement('flex-resizer');

                newFlex.className = "h";
                var newEvTarget = ev.target.cloneNode(true)
                newFlex.appendChild(newEvTarget);
                newFlex.appendChild(bar);
                newFlex.appendChild(newElement);
                newFlex.style.flexGrow = 1;

                /*ev.target.parentNode.appendChild(newFlex);
                ev.target.remove();*/
                ev.target.parentNode.replaceChild(newFlex, ev.target);
            }
            hideMenu();
        });
        $("#horizontalSplit").click(function () {
            if (ev.target.parentNode.getAttribute('class') == null) {
                ev.target.parentNode.setAttribute('class', 'v');
            }
            if (ev.target.parentNode.getAttribute('class') == 'v') {
                var newElement = document.createElement('flex-element');
                newElement.setAttribute('color', getRandomColor());
                newElement.setAttribute('flex', '1');
                newElement.setAttribute('text', 'new element');
                var bar = document.createElement('flex-resizer');
                //ev.target.parentNode.appendChild(bar);
                //ev.target.parentNode.appendChild(newElement);

                ev.target.parentNode.insertBefore(newElement, ev.target.nextSibling);
                ev.target.parentNode.insertBefore(bar, newElement);
            }
            if (ev.target.parentNode.getAttribute('class') == 'h') {
                /*
                var oldItem = ev.target;
                var newItem = document.createElement('flex-element');
                var verticalFlex = document.createElement('flex');
                verticalFlex.className = "v";
                //verticalFlex.appendChild(oldItem);
                verticalFlex.appendChild(newItem);

                ev.target.parentNode.appendChild(verticalFlex);
                ev.target.remove();*/
                var newFlex = document.createElement('flex');

                var newElement = document.createElement('flex-element');
                newElement.setAttribute('color', getRandomColor());
                newElement.setAttribute('flex', '1');
                newElement.setAttribute('text', 'new element');
                var bar = document.createElement('flex-resizer');

                newFlex.className = "v";
                var newEvTarget = ev.target.cloneNode(true)
                newFlex.appendChild(newEvTarget);
                newFlex.appendChild(bar);
                newFlex.appendChild(newElement);
                newFlex.style.flexGrow = 1;

                /*ev.target.parentNode.appendChild(newFlex);
                ev.target.remove();*/
                ev.target.parentNode.replaceChild(newFlex, ev.target);
            }
            hideMenu();
        });
        $("#remove").click(function () {
            var next = ev.target.nextSibling == null ? '' : ev.target.nextSibling.nodeName;
            var prev = ev.target.previousSibling == null ? '' : ev.target.previousSibling.nodeName;
            if (next == 'FLEX-RESIZER' && prev == 'FLEX-RESIZER') {
                ev.target.nextSibling.remove();
            }
            else {
                if (next == "FLEX-RESIZER") {
                    ev.target.nextSibling.remove();
                }
                if (prev == "FLEX-RESIZER") {
                    ev.target.previousSibling.remove();
                }
            }

            ev.target.remove();
            hideMenu();
        });
        menu.className = "show";
        menu.style.top = ev.clientY + 'px';
        menu.style.left = ev.clientX + 'px';
        textArea.value = ev.target.innerHTML;
        color.setAttribute("value", rgb2hex($(ev.target).css('backgroundColor')));
    }
    /*
    handleClick(ev) {
        let text = this.getAttribute('text') || '';
        console.log(text)
        //this.remove();
        var newElement = document.createElement('flex-element');
        newElement.setAttribute('color', 'green');
        newElement.setAttribute('flex', '1');
        newElement.setAttribute('text', text);
        this.appendChild(newElement);
    }
    */
    disconnectedCallback() {
        //console.log("removed");
    }

    static get observedAttributes() {
        return ['color', 'flex', 'text'];
    }

    attributeChangedCallback(name, oldValue, newValue) {
        //console.log(name, oldValue, newValue);
    }
}

customElements.define('flex-element', FlexElement);

$(document).ready(function () {
    var container = document.getElementsByClassName('container')[0];

    let params = (new URL(document.location)).searchParams;
    let id = params.get("id");

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var drawing = JSON.parse(this.responseText);

            if (drawing.length == 0) {
                console.log("Drawing not found");
            }
            else {
                console.log("già creato");
                document.getElementsByClassName('container')[0].remove();
                var newFlex = document.createElement('div');
                newFlex.innerHTML = drawing["0"]["structure"];
                document.body.prepend(newFlex);
            }

        }
    };

    const idd = JSON.stringify({
        "id": id,
    });
    xmlhttp.open("GET", "../backend/requestDeterminedDrawing.php?x=" + idd, true);
    xmlhttp.send();
});

function rgbToHex(r, g, b) {
    return "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
}

function hideMenu() {
    document.getElementById("rmenu").className = "hide";
    var newMenu = document.getElementById("rmenu").cloneNode(true);
    document.body.appendChild(newMenu);
    document.getElementById("rmenu").remove();
}

$(".container").click(function () {
    hideMenu();
});
$("#save").click(function () {
    event.preventDefault();
    var data = document.getElementsByClassName("container")[0].outerHTML;
    var name = document.getElementById("name").value;
    let params = (new URL(document.location)).searchParams;
    let id = params.get("id");
    let username = params.get("username");
    $.post("../backend/addDrawing.php",
        {
            id: id,
            name: name,
            structure: data,
            username: username,
        },
        function (data, status) {
            alert("Data: " + data + "\nStatus: " + status);
        });
    hideMenu();
});

function handleClick(ev) {
    //document.getElementById("rmenu").className = "hide";
    hideMenu();
}

function manageResize(md, sizeProp, posProp) {
    var r = md.target;

    var prev = r.previousElementSibling;
    var next = r.nextElementSibling;
    if (!prev || !next) {
        return;
    }

    md.preventDefault();

    var prevSize = prev[sizeProp];
    var nextSize = next[sizeProp];
    var sumSize = prevSize + nextSize;
    var prevGrow = Number(prev.style.flexGrow);
    var nextGrow = Number(next.style.flexGrow);
    var sumGrow = prevGrow + nextGrow;
    var lastPos = md[posProp];

    function onMouseMove(mm) {
        var pos = mm[posProp];
        var d = pos - lastPos;
        prevSize += d;
        nextSize -= d;
        if (prevSize < 0) {
            nextSize += prevSize;
            pos -= prevSize;
            prevSize = 0;
        }
        if (nextSize < 0) {
            prevSize += nextSize;
            pos += nextSize;
            nextSize = 0;
        }

        var prevGrowNew = sumGrow * (prevSize / sumSize);
        var nextGrowNew = sumGrow * (nextSize / sumSize);

        prev.style.flexGrow = prevGrowNew;
        next.style.flexGrow = nextGrowNew;

        lastPos = pos;
    }

    function onMouseUp(mu) {
        // Change cursor to signal a state's change: stop resizing.
        const html = document.querySelector('html');
        html.style.cursor = 'default';

        if (posProp === 'pageX') {
            r.style.cursor = 'ew-resize';
        } else {
            r.style.cursor = 'ns-resize';
        }

        window.removeEventListener("mousemove", onMouseMove);
        window.removeEventListener("mouseup", onMouseUp);
    }

    window.addEventListener("mousemove", onMouseMove);
    window.addEventListener("mouseup", onMouseUp);
}

function setupResizerEvents() {
    document.body.addEventListener("mousedown", function (md) {

        // Used to avoid cursor's flickering
        const html = document.querySelector('html');

        var target = md.target;
        if (target.nodeType !== 1 || target.tagName !== "FLEX-RESIZER") {
            return;
        }
        var parent = target.parentNode;
        var h = parent.classList.contains("h");
        var v = parent.classList.contains("v");
        if (h && v) {
            return;
        } else if (h) {
            // Change cursor to signal a state's change: begin resizing on H.
            target.style.cursor = 'col-resize';
            html.style.cursor = 'col-resize'; // avoid cursor's flickering

            // use offsetWidth versus scrollWidth (and clientWidth) to avoid splitter's jump on resize when a flex-item content overflow (overflow: auto).
            manageResize(md, "offsetWidth", "pageX");

        } else if (v) {
            // Change cursor to signal a state's change: begin resizing on V.
            target.style.cursor = 'row-resize';
            html.style.cursor = 'row-resize'; // avoid cursor's flickering

            manageResize(md, "offsetHeight", "pageY");
        }
    });
}
function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

setupResizerEvents();