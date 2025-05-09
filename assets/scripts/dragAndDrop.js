
import interact from 'interactjs'

console.log("DND loaded");


interact('.draggable')
    .draggable ({
        inertia: true,
        modifiers: [
            interact.modifiers.restrictRect({
                restriction: 'parent',
                endOnly: true
            })
        ],
        autoScroll: true,
        listeners: {
            move(ev){
                const target = ev.target;

                console.log(target);

                const x = (parseFloat(target.getAttribute('data-x')) || 0) + ev.dx
                const y = (parseFloat(target.getAttribute('data-y')) || 0) + ev.dy

                target.style.transform = 'translate(' + x + 'px, ' + y + 'px)'

                target.setAttribute('data-x', x)
                target.setAttribute('data-y', y)
            }

        },
    })
