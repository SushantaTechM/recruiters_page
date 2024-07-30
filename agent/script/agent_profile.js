function toggleEdit(fieldId) {
    const field = document.getElementById(fieldId);
    if (field.hasAttribute('readonly')) {
        field.removeAttribute('readonly');
        field.focus();
    } else {
        field.setAttribute('readonly', true);
    }
}


const updateBtn = document.getElementById('agent-profile-update-btn');
updateBtn.addEventListener('click',()=>{
    alert('Profile Updated');
})