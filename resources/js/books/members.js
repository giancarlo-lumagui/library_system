import '../bootstrap';
console.log('here')

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('formData');
    const delForm = document.getElementById('delForm');
    const editForm = document.getElementById('editForm');
    const table = document.getElementById('memberList');
    const addModalEl = document.getElementById('addMemberModal');
    const editModalEl = document.getElementById('editMemberModal');
    // const delModalEl = document.getElementById('deleteMemberModal');
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    console.log('here2');
    console.log('here6');
    const addMember = bootstrap.Modal.getOrCreateInstance(addModalEl);
    const edMember = bootstrap.Modal.getOrCreateInstance(editModalEl);
    // const delMember = bootstrap.Modal.getOrCreateInstance(delModalEl);
    console.log('here5');
    let editId = null;
    let deleteId = null;
    let currentMembers = [];
    console.log('here3');
    loadMembers();
    console.log('here4');
    table.addEventListener('click', e => {
        const row = e.target.closest('tr');
        if (!row) return;
        const id = row.dataset.id;

        if (e.target.closest('.edit-btn')) editMember(id);
        if (e.target.closest('.delete-btn')) deleteMemberFunc(id);
    });

    form.addEventListener('submit', async e => {
        e.preventDefault();
        const firstName = document.getElementById('firstName').value;
        const lastName = document.getElementById('lastName').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const address = document.getElementById('address').value;

        const res = await fetch('/members/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ firstName, lastName, email, phone, address })
        });

        if (res.ok) { addMember.hide(); form.reset(); loadMembers(); }
        else console.error("Failed to add member");
    });

    async function loadMembers() {
        const res = await fetch('/members/show');
        const data = await res.json();
        if (!data.members.length) {
            table.innerHTML = '<tr><td colspan="5" class="text-center">No members found</td></tr>';
            return;
        }

        currentMembers = data.members;
        table.innerHTML = data.members.map(m => `
            <tr data-id="${m.id}">
                <td>${m.first_name}</td>
                <td>${m.last_name}</td>
                <td>${m.email}</td>
                <td>${m.phone ?? ''}</td>
                <td>
                    <button class="btn btn-outline-warning edit-btn"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-outline-danger delete-btn"><i class="bi bi-trash"></i></button>
                </td>
            </tr>
        `).join('');
    }

    function editMember(id) {
        const member = currentMembers.find(m => m.id == id);
        if (!member) return console.error("Member not found");

        document.getElementById('editFirstName').value = member.first_name;
        document.getElementById('editLastName').value = member.last_name;
        document.getElementById('editEmail').value = member.email;
        document.getElementById('editPhone').value = member.phone;
        document.getElementById('editAddress').value = member.address;

        editId = id;
        edMember.show();
    }

    editForm.addEventListener('submit', async e => {
        e.preventDefault();
        if (!editId) return;

        const editFirstName = document.getElementById('editFirstName').value;
        const editLastName = document.getElementById('editLastName').value;
        const editEmail = document.getElementById('editEmail').value;
        const editPhone = document.getElementById('editPhone').value;
        const editAddress = document.getElementById('editAddress').value;

        const res = await fetch(`/members/${editId}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': token },
            body: JSON.stringify({ editFirstName, editLastName, editEmail, editPhone, editAddress })
        });

        if (res.ok) { edMember.hide(); loadMembers(); editId = null; }
        else console.error("Failed to update member");
    });

    function deleteMemberFunc(id) {
        deleteId = id;
        delMember.show();
    }

    delForm.addEventListener('submit', async e => {
        e.preventDefault();
        if (!deleteId) return;

        const res = await fetch(`/members/${deleteId}`, { method: 'DELETE', 'X-CSRF-TOKEN': token });
        if (res.ok) { delMember.hide(); loadMembers(); deleteId = null; }
        else console.error("Failed to delete member");
    });
});
