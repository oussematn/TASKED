//! Category
// faking submit
document.querySelector('.submit-btn-category-fake').addEventListener('click', () => { document.querySelector('.add-category-form').submit() })

// category color
let colors = document.querySelectorAll('.circle');
for (let i = 0; i < colors.length; i++) {
    const color = colors[i];
    color.addEventListener('click', e => {
        const selected = e.target;
        document.querySelector('#color').value = selected.style.background;
        selected.classList.add('selected-color');
        for (let j = 0; j < colors.length; j++) {
            if (colors[j] != e.target) {
                colors[j].classList.remove('selected-color');
            }
        }
    })
}


/* let edit_forms = document.querySelectorAll('.edit-form');
for (let i = 0; i < edit_forms.length; i++) {
    edit_forms[i].addEventListener('submit', (e) => {
        e.preventDefault();
        let name = prompt('Edit task');
        edit_forms[i].children[2].value = name;
        console.log(edit_forms[i].children[2].value);
        edit_forms[i].submit();
    });
} */

const draggables = document.querySelectorAll('.draggable');
let dragger = dragula({});
for (let i = 0; i < draggables.length; i++) {
    dragger.containers.push(draggables[i]);
}
dragger.on('drop', (el, target, source, sibling) => {
    const task = el.id;
    const cat = target.parentElement.parentElement.id;
    /*  const form = document.querySelector('#change-cat-form');
     const taskInput = document.querySelector('#task-input');
     const category = document.querySelector('#category-input');
     taskInput.value = task;
     category.value = cat;
     form.submit(); */
    const formData = new FormData();
    formData.append('task', '1');
    formData.append('category', '2');
    let data = {
        task: task,
        category: cat
    }
    fetch('/tasks/changecat', {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    }).then(res => console.log(res))
});

//! Deleting tasks
const trashs = document.querySelectorAll('.fa-trash-alt');
for (let i = 0; i < trashs.length; i++) {
    trashs[i].addEventListener('click', e => {
        const id = e.target.parentElement.parentElement.id;
        fetch(`/tasks/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            }
        }).then(res => {
            console.log(res);
            e.target.parentElement.parentElement.style.display = 'none'
        })
    })
}

//! Editing tasks
const edits = document.querySelectorAll('.fa-edit');
for (let i = 0; i < edits.length; i++) {
    edits[i].addEventListener('click', e => {
        const id = e.target.parentElement.parentElement.id;
        const name = prompt('Edit Task');
        fetch(`/tasks/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ name: name })
        }).then(res => {
            console.log(res);
            e.target.parentElement.parentElement.children[0].innerHTML = name;
        })
    })
}

//! Deleting category

const cross_icons = document.querySelectorAll('.fa-times-circle');
for (let i = 0; i < cross_icons.length; i++) {
    cross_icons[i].addEventListener('click', e => {
        if (confirm('Are you sure you want to delete this category?')) {
            const id = e.target.parentElement.parentElement.id;
            fetch(`/categories/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                }
            }).then(res => {
                console.log(res);
                e.target.parentElement.parentElement.style.display = 'none'
            })
        }
    })
}