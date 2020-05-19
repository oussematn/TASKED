//! Category
document.querySelector('.submit-btn-category-fake').addEventListener('click', () => { document.querySelector('.add-category-form').submit() })

let edit_forms = document.querySelectorAll('.edit-form');
for (let i = 0; i < edit_forms.length; i++) {
    edit_forms[i].addEventListener('submit', (e) => {
        e.preventDefault();
        let name = prompt('Edit task');
        edit_forms[i].children[2].value = name;
        console.log(edit_forms[i].children[2].value);
        edit_forms[i].submit();
    });
}